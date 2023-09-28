<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit.prevent="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Start Date <span class="text-danger">*</span></label>
                                    <input wire:model.defer="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>End Date <span class="text-danger">*</span></label>
                                    <input wire:model.defer="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Cashier Name:</label>
                                    <select wire:model.defer="customer_id" class="form-control" name="customer_id">
                                        <option value="">Select Cashier</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ auth()->user()->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select wire:model.defer="sale_status" class="form-control" name="sale_status">
                                        <option value="">Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Payment Status</label>
                                    <select wire:model.defer="payment_status" class="form-control" name="payment_status">
                                        <option value="">Select Payment Status</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Partial">Partial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                Filter Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <table id="sales-table" class="table table-bordered table-striped text-center mb-0">
                            <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <thead>
                            <tr>
                            <th>Date</th>
                            <th>Reference</th>
                        <!--    <th>Cashier</th> -->
                            <th>Status</th>
                            <th>Received</th>
                            <th>Change</th>
                            <th>Total</th>
                            <th>Payment Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</td>
                                <td>{{ $sale->reference }}</td>
                              <!--  <td>{{ $sale->customer_name }}</td> -->
                                <td>
                                    @if ($sale->status == 'Pending')
                                        <span class="badge badge-info">
                                    {{ $sale->status }}
                                </span>
                                    @elseif ($sale->status == 'Shipped')
                                        <span class="badge badge-primary">
                                    {{ $sale->status }}
                                </span>
                                    @else
                                        <span class="badge badge-success">
                                    {{ $sale->status }}
                                </span>
                                    @endif
                                </td>
                                <td>{{ format_currency($sale->paid_amount) }}</td>
                                <td>{{ format_currency($sale->due_amount) }}</td>
                                <td>{{ format_currency($sale->total_amount) }}</td>
                                <td>
                                    @if ($sale->payment_status == 'Partial')
                                        <span class="badge badge-warning">
                                    {{ $sale->payment_status }}
                                </span>
                                    @elseif ($sale->payment_status == 'Paid')
                                        <span class="badge badge-success">
                                    {{ $sale->payment_status }}
                                </span>
                                    @else
                                        <span class="badge badge-danger">
                                    {{ $sale->payment_status }}
                                </span>
                                    @endif

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">No Sales Data Available!</span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                            <!-- Add the total row here -->
                            <tfoot>
                                <tr style="background-color: #f5f5f5;">
                                    <td colspan="5" class="text-right font-weight-bold">Grand Total:</td>
                                    <td class="font-weight-bold" colspan="2">
                                        <span id="grand-total"></span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div @class(['mt-3' => $sales->hasPages()])>
                            {{ $sales->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            calculateTotal();
        });

        function calculateTotal() {
            let table = document.getElementById("sales-table");
            let rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
            let total = 0;

            for (let i = 0; i < rows.length; i++) {
                let cell = rows[i].getElementsByTagName("td")[5]; // "Total" column is the 6th column (0-based index)
                if (cell) {
                    let amount = parseFloat(cell.innerText.replace(/[^0-9.-]+/g, ""));
                    total += isNaN(amount) ? 0 : amount;
                }
            }

            // Display the total
            let totalCell = document.getElementById("grand-total");
            if (totalCell) {
                totalCell.innerText = formatCurrency(total);
            }
        }

        // Format currency function (you can define your own formatting logic here)
        function formatCurrency(amount) {
            return "₱" + amount.toFixed(2); // Example format: $123.45
        }
    </script>

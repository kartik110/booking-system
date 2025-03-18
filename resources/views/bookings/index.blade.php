<x-app-layout>
    @push('styles')
        <!-- Bootstrap 4 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <!-- DataTables Bootstrap 4 CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

        <style>
            /* Custom Styling */
            .card {
                border: none;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
            }

            .card-header {
                background: linear-gradient(45deg, #007bff, #6610f2);
                color: white;
                font-size: 1.25rem;
                font-weight: bold;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }

            .table {
                border-radius: 10px;
                overflow: hidden;
            }

            .table thead {
                background: #343a40;
                color: white;
                text-transform: uppercase;
            }

            .table tbody tr:hover {
                background: #f8f9fa;
                transition: 0.3s ease-in-out;
            }

            .container {
                padding-top: 30px;
            }
        </style>
    @endpush

    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-list-ul"></i> Bookings List
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="bookings-table" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Booking Date</th>
                            <th>Type</th>
                            <th>Slot</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap 4 JS & Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <!-- Font Awesome for Icons -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#bookings-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("bookings.datatable") }}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'customer_name', name: 'customer_name' },
                        { data: 'booking_date', name: 'booking_date' },
                        { data: 'type', name: 'type' },
                        { data: 'slot', name: 'slot' },
                        { data: 'start_time', name: 'start_time' },
                        { data: 'end_time', name: 'end_time' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    order: [[0, 'desc']],
                    responsive: true
                });
            });
        </script>
    @endpush
</x-app-layout>

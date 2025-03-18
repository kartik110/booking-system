<x-app-layout>
    <div class="container">
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf
    
            <!-- Customer Fields -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                </div>
                <div class="col-md-6">
                    <label for="customer_email" class="form-label">Customer Email</label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                </div>
            </div>
    
            <!-- Booking Date -->
            <div class="mb-3">
                <label for="booking_date" class="form-label">Booking Date</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date" min="{{ date('Y-m-d') }}" required>
            </div>
    
            <!-- Booking Type -->
            <div class="mb-3">
                <label for="type" class="form-label">Booking Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="">Select Type</option>
                    <option value="full_day">Full Day</option>
                    <option value="half_day">Half Day</option>
                    <option value="custom">Custom</option>
                </select>
            </div>
    
            <!-- Half Day Slot (Conditional) -->
            <div class="mb-3" id="slotField" style="display: none;">
                <label for="slot" class="form-label">Booking Slot</label>
                <select class="form-select" id="slot" name="slot">
                    <option value="first_half">First Half</option>
                    <option value="second_half">Second Half</option>
                </select>
            </div>
    
            <!-- Custom Time (Conditional) -->
            <div class="row mb-3" id="timeFields" style="display: none;">
                <div class="col-md-6">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="time" class="form-control" id="start_time" name="start_time">
                </div>
                <div class="col-md-6">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="time" class="form-control" id="end_time" name="end_time">
                </div>
            </div>
    
            <button type="submit" class="btn btn-primary">Submit Booking</button>
        </form>
    </div>

    <script>
        document.getElementById('type').addEventListener('change', function() {
            const type = this.value;
            document.getElementById('slotField').style.display = type === 'half_day' ? 'block' : 'none';
            document.getElementById('timeFields').style.display = type === 'custom' ? 'block' : 'none';
        });
        </script>
</x-app-layout>
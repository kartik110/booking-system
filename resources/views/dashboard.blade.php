<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

        <style>
            .form-container {
                max-width: 600px;
                margin: 40px auto;
                padding: 30px;
                background: #ffffff;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            }

            .form-label {
                font-weight: 600;
                color: #555;
            }

            .form-control, .form-select {
                border-radius: 8px;
                border: 1px solid #ddd;
                transition: 0.3s ease-in-out;
            }

            .form-control:focus, .form-select:focus {
                border-color: #007bff;
                box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
            }

            .btn-primary {
                background: linear-gradient(45deg, #007bff, #6610f2);
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                border-radius: 8px;
                transition: 0.3s ease-in-out;
            }

            .btn-primary:hover {
                background: linear-gradient(45deg, #6610f2, #007bff);
            }

            .text-danger {
                font-size: 0.875rem;
            }
        </style>
    @endpush

    <div class="container">
        <div class="form-container">
            <h3 class="text-center mb-4 text-primary">Book Your Slot</h3>

            <!-- Display Global Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf

                <!-- Customer Fields -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                               id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                        @error('customer_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customer_email" class="form-label">Customer Email</label>
                        <input type="email" class="form-control @error('customer_email') is-invalid @enderror" 
                               id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                        @error('customer_email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Booking Date -->
                <div class="mb-3">
                    <label for="booking_date" class="form-label">Booking Date</label>
                    <input type="date" class="form-control @error('booking_date') is-invalid @enderror" 
                           id="booking_date" name="booking_date" min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}" required>
                    @error('booking_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Booking Type -->
                <div class="mb-3">
                    <label for="type" class="form-label">Booking Type</label><br>
                    <select class="form-select w-100 @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="full_day" {{ old('type') == 'full_day' ? 'selected' : '' }}>Full Day</option>
                        <option value="half_day" {{ old('type') == 'half_day' ? 'selected' : '' }}>Half Day</option>
                        <option value="custom" {{ old('type') == 'custom' ? 'selected' : '' }}>Custom</option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Half Day Slot (Conditional) -->
                <div class="mb-3" id="slotField" style="display: none;">
                    <label for="slot" class="form-label">Booking Slot</label><br>
                    <select class="form-select w-100 @error('slot') is-invalid @enderror" id="slot" name="slot">
                        <option value="first_half" {{ old('slot') == 'first_half' ? 'selected' : '' }}>First Half</option>
                        <option value="second_half" {{ old('slot') == 'second_half' ? 'selected' : '' }}>Second Half</option>
                    </select>
                    @error('slot')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Custom Time (Conditional) -->
                <div class="row mb-3" id="timeFields" style="display: none;">
                    <div class="col-md-6">
                        <label for="start_time" class="form-label">Start Time</label><br>
                        <input type="time" class="form-control w-100 @error('start_time') is-invalid @enderror" 
                               id="start_time" name="start_time" value="{{ old('start_time') }}">
                        @error('start_time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control @error('end_time') is-invalid @enderror" 
                               id="end_time" name="end_time" value="{{ old('end_time') }}">
                        @error('end_time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit Booking</button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function toggleFields() {
                const type = document.getElementById('type').value;
                document.getElementById('slotField').style.display = type === 'half_day' ? 'block' : 'none';
                document.getElementById('timeFields').style.display = type === 'custom' ? 'block' : 'none';
            }

            document.getElementById('type').addEventListener('change', toggleFields);

            // Preserve old values on page reload
            window.onload = function() {
                toggleFields();
            };
        </script>
    @endpush
</x-app-layout>


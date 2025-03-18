<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{
    private $bookingRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function index()
    {
        return view('bookings.index');
    }

    public function datatable()
    {
        $bookings = Booking::with('user')->select('bookings.*');

        return DataTables::of($bookings)
            ->addColumn('action', function ($booking) {
                return '<a href="#" class="btn btn-sm btn-primary">View</a>';
            })
            ->editColumn('booking_date', function ($booking) {
                return $booking->booking_date; //->format('d-M-Y');
            })
            ->editColumn('start_time', function ($booking) {
                return $booking->start_time; //->format('d-M-Y');
            })
            ->editColumn('end_time', function ($booking) {
                return $booking->end_time; //->format('d-M-Y');
            })
            ->editColumn('type', function ($booking) {
                return ucfirst(str_replace('_', ' ', $booking->type));
            })
            ->editColumn('created_at', function ($booking) {
                return $booking->created_at->format('d-M-Y H:i');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(StoreBookingRequest $request)
    {
        if ($this->bookingRepository->checkAvailability($request->validated())) {
            return back()->withErrors(['booking_date' => 'This slot is already booked']);
        }

        $this->bookingRepository->createBooking(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );

        return redirect()->route('dashboard')->with('success', 'Booking created!');
    }
}

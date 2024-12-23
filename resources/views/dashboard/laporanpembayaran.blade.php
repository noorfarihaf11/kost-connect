@extends('dashboard.layouts.main')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.js"></script>

@section('content')
    <div class="container grid px-6 mx-auto">
        @can('owner')
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Laporan Pembayaran
            </h2>
        @else
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Tagihan Saya
            </h2>
            @endif

            <meta name="csrf-token" content="{{ csrf_token() }}">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

            <div class="flex justify-start space-x-4 mb-4">
                <button id="dailyReport" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 focus:outline-none">
                    Laporan Harian
                </button>
                <button id="monthlyReport"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 focus:outline-none">
                    Laporan Bulanan
                </button>
            </div>
            <table id="paymentsTable">
                <thead>
                    <tr>
                        <th>ID Payment</th>
                        <th>Nama</th>
                        <th>Kamar</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $tagihan)
                        @if ($tagihan->order_id)
                            <tr>
                                <td>{{ $tagihan->order_id }}</td>
                                <td>{{ $tagihan->reservation->user->name }}</td>
                                <td>{{ $tagihan->reservation->room->name }}</td>
                                <td>Rp {{ number_format($tagihan->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @if ($tagihan->payment_type == 'first_payment')
                                        Pembayaran pertama
                                    @elseif($tagihan->payment_type == 'monthly_payment')
                                        Pembayaran bulan {{ \Carbon\Carbon::parse($tagihan->updated_at)->month }}
                                    @else
                                        {{ $tagihan->payment_type }}
                                    @endif
                                </td>
                                <td>{{ $tagihan->updated_at }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>


            <div class="mt-6 text-center">
                <button id="downloadPDF"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Download as PDF
                </button>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.js"></script>

        <script>
            $(document).ready(function() {
                // Initialize DataTable
                $('#paymentsTable').DataTable({
                    paging: true, // Enable pagination
                    searching: true, // Enable search box
                    ordering: true, // Enable sorting
                    info: true, // Show info text (e.g. "Showing 1 to 10 of 50 entries")
                    lengthChange: true, // Allow changing number of entries per page
                    pageLength: 10 // Default number of entries per page
                });

                // Button click for generating PDF
                $('#downloadPDF').click(function() {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF();

                    // Get the title from the h2 element
                    const reportTitle = $('h2').text();

                    // Add the report title to the PDF
                    doc.setFontSize(18);
                    doc.text(reportTitle, 14, 20); // Position the title at the top of the page

                    // Generate PDF from the table data
                    doc.autoTable({
                        html: '#paymentsTable',
                        startY: 30, // Start rendering below the title
                        theme: 'grid',
                    });

                    // Save the generated PDF
                    doc.save('payment_report.pdf');
                });

                // Button click for daily report
                $('#dailyReport').click(function() {
                    window.location.href =
                    "/laporanpembayaran?report_type=daily"; // Redirect to daily report route
                });

                // Button click for monthly report
                $('#monthlyReport').click(function() {
                    window.location.href =
                    "/laporanpembayaran?report_type=monthly"; // Redirect to monthly report route
                });
            });
        </script>
    @endsection

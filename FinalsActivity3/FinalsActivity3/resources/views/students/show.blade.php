@extends('layouts.app')

@section('content')
    <h2>{{ $student->firstname }} {{ $student->lastname }}</h2>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Address:</strong> {{ $student->address }}</p>
    <p><strong>Student ID:</strong> {{ $student->studentID }}</p>
    <p><strong>Course:</strong> {{ $student->course }}</p>
    <p><strong>Year Level:</strong> {{ $student->yearlevel }}</p>

    <h4>QR Code</h4>
    <div id="qr-section">
        {!! $qr !!}
    </div>

    <button onclick="printQR()" class="btn btn-outline-primary mt-3">🖨️ Print QR</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">← Back</a>

    <script>
        function printQR() {
            var qrContent = document.getElementById('qr-section').innerHTML;
            var printWindow = window.open('', '', 'height=400,width=400');
            printWindow.document.write('<html><head><title>Print QR Code</title></head><body style="text-align:center;">');
            printWindow.document.write(qrContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    </script>
@endsection

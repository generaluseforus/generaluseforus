@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <a class="navbar-brand" href="{{ route('add-expense') }}">Add Expense</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ request()->segment(count(request()->segments())) }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('report.id', 'all') }}">
                            {{ __('All') }}
                        </a>

                        @foreach($years AS $year)
                            <a class="dropdown-item" href="{{ route('report.id', $year->year) }}">
                                {{ $year->year }}
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row justify-content-center">
        <div class="card-body">
            <div class="">
                <table id="accountTable" class="table table-striped cell-border" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-start">#</th>
                            <th class="text-start">Date</th>
                            <th class="text-start">Amount Spent</th>
                            <th class="text-start">Descritpion</th>
                            <th class="text-start">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach($accountData as $data)
                            <tr>
                                <td class="text-start align-middle">{{ $count }}</td>
                                <td class="text-start align-middle">{{ date('d-m-y', strtotime($data->date)) }}</td>
                                <td class="text-start align-middle text-danger border-dark">{{ number_format($data->amount_spent, 2) }}</td>
                                <td class="text-start align-middle">{{ $data->description }}</td>
                                <td class="text-start align-middle">
                                    <button type="button" class="btn btn-warning">
                                        <a href="{{ route('edit-expense', $data->id) }}" class="text-decoration-none text-light">{{ __('Update') }}</a>
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <a href="{{ route('delete-expense', $data->id) }}" class="text-decoration-none text-light">{{ __('Delete') }}</a>
                                    </button>
                                </td>
                            </tr>

                            @php $count++; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-start">-----</th>
                            <th class="text-start">Total</th>
                            <th class="text-start text-danger"></th>
                            <th class="text-start">-----</th>
                            <th class="text-start">-----</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#accountTable').DataTable({
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                }
            }
        });

        // function calculateTotal() {
        //     var total = table.column(2, { search: 'applied' }).data().reduce(function(a, b) {
        //         return parseFloat(a) + parseFloat(b);
        //     }, 0);

        //     return total;
        // }

        // // Initial calculation and update
        // $('tfoot th:eq(2)').text(calculateTotal());

        // // Update the total whenever the DataTable is drawn (e.g., after pagination, sorting, searching)

        // table.on('search.dt', function() {
        //     $('tfoot th:eq(2)').text(calculateTotal());
        // });

        // var sum = 0;
        // table.column(2).data().each(function(value) { // Assuming the values are in the fourth column (index 3)
        //     // Remove any non-numeric characters and parse as float
        //     var numericValue = parseFloat(value.toString().replace(/[^\d.-]/g, ''));
        //     // Add to sum
        //     sum += numericValue;
        // });

        // // Format sum as needed
        // // var formattedSum = sum.toFixed(2); // Formats as a decimal with 2 decimal places

        // // Format sum with commas for thousands separators and period for decimal separator
        // var formattedSum = sum.toLocaleString(undefined, {
        //     minimumFractionDigits: 2,
        //     maximumFractionDigits: 2
        // });



        var formattedSum; // Declare formattedSum variable outside the function

        // Function to calculate and update sum
        function updateSum() {
            // Calculate sum
            var sum = 0;
            table.column(2, { search: 'applied' }).data().each(function(value) { // Considering the search is applied to the fourth column (index 3)
                // Remove any non-numeric characters and parse as float
                var numericValue = parseFloat(value.toString().replace(/[^\d.-]/g, ''));
                // Add to sum
                sum += numericValue;
            });

            // Format sum with commas for thousands separators and period for decimal separator
            formattedSum = sum.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // Display sum in the footer
            $('#accountTable tfoot').find('th').eq(2).text(formattedSum); // Assuming the sum should be displayed in the footer of the fourth column
        }

        // Initial update of sum
        updateSum();

        // Re-calculate sum whenever a search is performed
        table.on('search.dt', function() {
            updateSum();
        });



        // Display sum in the footer
        $('#accountTable tfoot').find('th').eq(2).text(formattedSum); 

        setTimeout(function () {
            $('.alert-success').hide();
        }, 3000);
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">    
        <a href="{{ route('index') }}">Index</a>
    </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach($accountData as $data)
                            <tr>
                                <td class="text-start">{{ $count }}</td>
                                <td class="text-start">{{ date('d-m-y', strtotime($data->date)) }}</td>
                                <td class="text-start text-danger border-dark">{{ number_format($data->amount_spent, 2) }}</td>
                                <td class="text-start">{{ $data->description }}</td>
                            </tr>

                            @php $count++; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-start">--------------------------</th>
                            <th class="text-start">Total</th>
                            <th class="text-start text-danger"></th>
                            <th class="text-start">--------------------------</th>
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
    <!-- // build table data -->
        <thead>
            <tr>
            @foreach ($ths as $th) 
                <th class='text-center'> {{ $th }}</th>
            @endforeach    
            </tr>
        </thead>
        <tbody>

          @foreach($tds as $td )
            <tr class="row{{$td['id']}} ">
                @foreach($tdOnly as $only)

                    @if($only == 'product_id')
                    <td class='text-center'>{{ $td->getProduct->name }}</td>
                    @else
                    <td class='text-center'>{{ ( $only == 'total_price' ) || ( $only == 'sell_price' ) ? round($td->$only,3) : $td->$only }}</td>
                    @endif

                @endforeach
            </tr>
          @endforeach      
        </tbody>

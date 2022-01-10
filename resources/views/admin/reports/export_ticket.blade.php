<table>
    <thead>
    <tr>
        <th>Ticket ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>IC No.</th>
        <th>Phone No.</th>
        <th>Email</th>
        <th>Package</th>
        <th>Purchased At</th>
    
    </tr>
    </thead>
    <tbody>
    @foreach($student as $students) 
    @foreach($ticket as $tickets)
    @foreach($package as $packages)
    @if ($tickets->ic == $students->ic)
    @if ($tickets->package_id == $packages->package_id)
        <tr>
            <td>{{ $tickets->ticket_id }}</td>
            <td>{{ $students->first_name }}</td>
            <td>{{ $students->last_name }}</td>
            <td>{{ $students->ic }}</td>
            <td>{{ $students->phoneno }}</td>
            <td>{{ $students->email }}</td>
            <td>{{ $packages->name }}</td>
            <td>{{ $tickets->ticket_type }}</td>
            <td>{{  date('d-m-Y h:i a', strtotime($tickets->created_at))  }}</td>
        </tr>
    @endif
    @endif
    @endforeach
    @endforeach
    @endforeach
    </tbody>
</table>
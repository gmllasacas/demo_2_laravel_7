<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>NIVEL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->superior->name ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
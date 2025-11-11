
<link rel="stylesheet" href="{{ url('Backend/css/programs_duration.css') }}">
  <div class="whole_form">
    <div class="heading"><h3>Scholarships</h3></div>
    <table id="dataTable">
     @if (!empty($scholarship_data) && count($scholarship_data))
      <thead>
        <tr>
          <th style="width:50px; text-align:center;">No</th>
          <th>Check List</th>
          <th style="text-align:center;width:60px;">Action</th>
        </tr>
      </thead>
        <tbody>
            <!-- ______________________ -->
            @foreach ($scholarship_data as $list)
            <form action="{{ route('admin.scholarships.update') }}" method="POST">
                @csrf
                <tr>
                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <input type="hidden" name="id" value="{{ $list->id }}">
                    <td>
                        <input type="text" name="list_text" value="{{ $list->scholarship_text }}" />
                    </td>
                    <td>
                        <div class="actions">
                            <button type="submit"><i style="color: rgb(2, 112, 207);" class="fa-regular fa-floppy-disk"></i></button>
                            <a href="{{ route('admin.scholarships.delete', $list->id) }}"><button type="button"><i class="fa-solid fa-trash-can"></i></button></a>
                        </div>
                    </td>
                </tr>
            </form>
            @endforeach
        </tbody>
        @endif
        <!-- ______________________ -->
       <thead>
        <tr>
          <th style="width:50px; text-align:center;">No</th>
          <th>Add New Data</th>
        </tr>
      </thead>
      <tbody>
        <form action="{{route('admin.scholarships.create')}}" method="POST">
           @csrf
          <tr>
            <td style="text-align:center;">1</td>
              <input type="hidden" name="items[0][info_id]" value="{{ $existInfo->id }}">
            <td><input type="text" name="items[0][list_text]" /></td>
          </tr>
          <tr>
            <td style="text-align:center;">2</td>
              <input type="hidden" name="items[1][info_id]" value="{{ $existInfo->id }}">
            <td><input type="text" name="items[1][list_text]" /></td>
          </tr>
          <tr>
            <td style="text-align:center;">3</td>
              <input type="hidden" name="items[2][info_id]" value="{{ $existInfo->id }}">
            <td><input type="text" name="items[2][list_text]" /></td>
          </tr>
        <!-- ______________________ -->
      </tbody>
    </table>

    <div class="buttons">
        <button type="submit">Save</button>
    </div>
    </form>
  </div>


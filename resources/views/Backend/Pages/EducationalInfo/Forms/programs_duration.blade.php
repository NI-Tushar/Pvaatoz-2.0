
<link rel="stylesheet" href="{{ url('Backend/css/programs_duration.css') }}">
  <div class="whole_form">
    <div class="heading"><h3>Programs & Duration</h3></div>
    <table id="dataTable">
      <thead>
        <tr>
          <th style="width:50px; text-align:center;">No</th>
          <th>Programs</th>
          <th>Duration</th>
          <th style="text-align:center;">Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- ______________________ -->
        <form action="{{route('admin.programsDuration.update')}}" method="POST">
          @csrf
            @foreach($items as $index => $item)
            <tr>
              <td style="text-align:center;">{{ $index + 1 }}</td>
              <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
              <td><input type="text" name="items[{{ $index }}][programs]" value="{{ $item->programs }}" /></td>
              <td><input type="text" name="items[{{ $index }}][duration]" value="{{ $item->duration }}" /></td>
              <td>
                <button type="button" onclick="removeRow(this)">
                  <i class="fa-solid fa-trash-can"></i>
                </button>
              </td>
            </tr>
            @endforeach
          <div class="buttons">
            <button type="submit">Update</button>
          </div>
        </form>
        <!-- ______________________ -->
        <form action="{{route('admin.programsDuration.create')}}" method="POST">
           @csrf
          <tr>
            <input type="hidden" name="info_id" value=""/>
            <td style="text-align:center;">1</td>
            <input type="hidden" name="items[0][info_id]" value="{{ $existInfo->id }}">
            <td><input type="text" name="items[0][programs]" /></td>
            <td><input type="text" name="items[0][duration]" /></td>
            <td><button type="button" onclick="removeRow(this)"><i class="fa-solid fa-trash-can"></i></button></td>
          </tr>
        <!-- ______________________ -->
      </tbody>
    </table>

    <div class="buttons">
        <button type="button" onclick="addRow()">Add Row <i class="fa-solid fa-plus"></i></button>
        <button type="submit">Save</button>
    </div>
    </form>
  </div>

  <script>
    function addRow() {
      const tableBody = document.querySelector('#dataTable tbody');
      const rowCount = tableBody.rows.length;

      const newRow = document.createElement('tr');

      newRow.innerHTML = `
        <td style="text-align:center;">${rowCount+1}</td>
        <input type="hidden" name="items[${rowCount}][info_id]" value="{{ $existInfo->id }}">
        <td><input type="text" name="items[${rowCount}][programs]" required /></td>
        <td><input type="text" name="items[${rowCount}][duration]" required /></td>
        <td><button type="button" onclick="removeRow(this)"><i class="fa-solid fa-trash-can"></i></button>
      `;

      tableBody.appendChild(newRow);
    }

    function removeRow(button) {
      const row = button.closest('tr');
      row.remove();

      // After removal, update input names to keep indexes sequential
      const rows = document.querySelectorAll('#dataTable tbody tr');
      rows.forEach((tr, index) => {
        tr.querySelector('input[name^="items"]').forEach((input) => {
          if(input.name.includes('[info_id]')) input.name = `items[${index}][info_id]`;
          if(input.name.includes('[programs]')) input.name = `items[${index}][programs]`;
          if(input.name.includes('[duration]')) input.name = `items[${index}][duration]`;
        });
      });
    }
  </script>

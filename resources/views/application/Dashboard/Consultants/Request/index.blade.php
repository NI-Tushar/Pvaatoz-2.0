@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')
<style>
    .container{
        border:1px solid red;
        overflow-x: auto;
        white-space: nowrap;
    }
</style>
<div class="container mt-3">
  <h4>Students Requests</h4>
  <p>This or These students has been requested to you</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Proffered Education</th>
        <th>Proffered Country</th>
        <th>Amount</th>
        <th>Request Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td>
            <div class="actions">
            <a href=""><button>Open</button></a>
            </div>
        </td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>

@endsection
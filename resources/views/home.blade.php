@extends('layout.app')

@section('titile')
    Home
@endsection

@include('partials.header')
@section('content')
    <div class="bg-gray m-5 p-5 rounded-lg bg-light">
        <div class="input-group mb-3">
            <div style="width: 70%">
                <input id="searchInput" type="text" class="form-control" placeholder="Task name" aria-label="Recipient's username" aria-describedby="basic-addon2">    
            </div>
            <select id="tagsMultipleSelect" multiple="multiple" placeholder="Tags">
                
            </select>
            <div class="input-group-append">
                <button id="searchButton" class="btn btn-outline-secondary" type="button">Search</button>
            </div>
        </div>
        <span class="bg-gray">My lists:</span> 
        
        <br />
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <input placeholder="Add new list" id="newTaskListName" type="text">
                <button id="createTaskListButton" class="btn btn-success ml-2" type="submit">
                    Add
                </button>
                <button id="updateTaskListButton" class="btn btn-success" type="submit">
                    Update
                </button>
            </div>
            <div id="updateButtonNextDiv">
                
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div style="width: 40%">
                <table class="table table-hover">
                    <tbody id="taskLists">
                        <tr>
                            <td>Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width: 58%">
                <table class="table rounded" style="background-color: rgb(231, 231, 231)">
                    <tbody id="tasks">
                        
                    </tbody>
                </table>
            </div>
        </div>        
    </div>

    {{-- JS --}}
    
@endsection
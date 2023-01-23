<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-2" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">      
                    <h4>Companies</h4>
                    <hr>
                    <div>
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Adress</th>
                                    <th>Show</th>                              
                                    <th>Redact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $companies as $company )
                                    <tr>
                                        <td><img width="35" src="{{ asset('public/storage') }}/{{ $company->logo }}" alt="ald" /></td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>                                              
                                        <td>{{ $company->adress }}</td>
                                        <td> 
                                            <a href="{{ route('company.show', ['company' => $company->id ]) }}"> 
                                                <button type="button" class="btn btn-sm btn-outline-primary">Show</button> 
                                            </a>
                                        </td>                                     
                                        <td> 
                                            <a href="{{ route('company.edit', ['company' => $company->id ]) }}"> 
                                                <button type="button" class="btn btn-sm btn-outline-primary">Redact</button>
                                            </a>                                             
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">                       
                        <div> 
                            <button type="button" class="btn btn-sm btn-outline-primary"> 
                                <a href="{{ route('company.create') }}">Add Company</a> 
                            </button>                             
                        </div>                      
                    </div>
               </div>

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

</x-app-layout>
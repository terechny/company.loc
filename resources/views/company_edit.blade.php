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
                    <h4>Company Edit</h4>
                    <hr>
                    <div class="row">
                               <div class="col-sm-4 bg-light">

                                    <div class="p-2">

                                        <form action="{{ route('company.update', ['company' => $company->id]) }}" method="POST" enctype="multipart/form-data">                                        
                                            <div class="mb-3">
                                                <label class="form-label">Company name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $company->name }}" require>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Adress</label>
                                                <input type="text" name="adress" class="form-control" value="{{ $company->adress }}" require>
                                            </div>                                    
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $company->email }}" require>
                                            </div> 
                                            @csrf
                                            <div class="input-group mb-3"> 
                                                <input type="file" name="logo" class="form-control">
                                            </div>
                                            <input type="hidden" name="_method" value="PUT">
                                            <button type="submit" class="btn btn-primary" id="add-company-btn">Edit company</button>  
                                        </form>
                                                                            
                                    </div>
                        
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
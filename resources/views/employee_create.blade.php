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
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                         
                        <div class="row">
                               <div class="col-sm-4 bg-light">

                                    <div class="p-2">

                                        <p class="mt-2"> <b> Add employee </b> </p>
                                        <hr>

                                        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">                                        
                                            <div class="mb-3">
                                                <label class="form-label">Company</label>
                                                <select name="company_id" id="" class="form-select">
                                                    @foreach($companies as $company)
                                                        <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>                                    
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div> 
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="tel" name="phone" class="form-control" required>
                                            </div> 
                                            @csrf
                                            <button type="submit" class="btn btn-primary" id="add-company-btn">Add employee</button>  
                                        </form>
                                                                            
                                    </div>
                        
                               </div>
                              
                        </div>
                    </div>
               </div>

            </div>

        </div>

    </div>

</x-app-layout>
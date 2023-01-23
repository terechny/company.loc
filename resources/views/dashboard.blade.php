<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Company</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                         
                        <div class="row">
                               <div class="col-sm-4 bg-light">
                                    <div class="p-2">                                       
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <a href="{{ route('company.index') }}">Company List</a>
                                            </li>
                                        </ul>                                                                               
                                    </div>                       
                               </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        $('#add-company-btn').click(function(){
            console.log(1111)
        });
    </script>
</x-app-layout>

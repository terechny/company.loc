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

                    <h4>Company</h4>

                    <hr>

                    <div class="row mt-4">  
                        
                        <div class="col-sm-4"> 
                            <div class="row"> 
                                <div class="col-sm-2"> <img width="100" src="{{ asset('public/storage') }}/{{ $company->logo }}" alt="ald" /> </div> 
                                <div class="col-sm-6">  <h1> {{ $company->name }}  </h1>  </div>
                            </div>                          
                            <div class="mt-4">                            
                                <table class="table">
                                    <tr>
                                        <td>email: </td>
                                        <td>{{ $company->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>adress: </td>
                                        <td>{{ $company->adress }}</td>
                                    </tr>
                                </table>
                                <p>
                                <a href="{{ route('employee.create') }}">
                                    <button type="button" class="btn btn-outline-primary">Add Employee</button>
                                </a> 
                                </p>
                            </div>
                        </div>   

                        <div class="col-sm-8"> 
                            <div id="map" class="bg-info" style="width: 100%; height: 300px"></div>  
                        </div>

                    </div>

                    <div class="bg-light mt-4">

                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Redact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $employees as $employee )
                                    <tr>
                                        <td>{{ $employee['name'] }}</td>    
                                        <td>{{ $employee['email'] }}</td>  
                                        <td>{{ $employee['phone'] }}</td>   
                                        <td>
                                            <a href="{{ route('employee.edit', ['employee' => $employee['id'] ]) }}"> 
                                                <button type="button" class="btn btn-sm btn-outline-primary">Redact</button>
                                            </a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

               </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $('#example').DataTable();
        });

//ymaps.ready(init);

function init() {
    var myMap = new ymaps.Map('map', {
        center: [55.753994, 37.622093],
        zoom: 9
    });

    // ?????????? ?????????????????? ???????????? ?????????????? ??????????????????.
    ymaps.geocode('?????????????????? ????-?? 21', {
        /**
         * ?????????? ??????????????
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
         */
        // ???????????????????? ?????????????????????? ???? ???????????? ???????? ??????????.
        // boundedBy: myMap.getBounds(),
        // strictBounds: true,
        // ???????????? ?? ???????????? boundedBy ?????????? ???????????? ???????????? ???????????? ??????????????, ?????????????????? ?? boundedBy.
        // ???????? ?????????? ???????????? ???????? ??????????????????, ???????????????? ???????????? ??????????????????????????.
        results: 1
    }).then(function (res) {
            // ???????????????? ???????????? ?????????????????? ????????????????????????????.
            var firstGeoObject = res.geoObjects.get(0),
                // ???????????????????? ????????????????????.
                coords = firstGeoObject.geometry.getCoordinates(),
                // ?????????????? ?????????????????? ????????????????????.
                bounds = firstGeoObject.properties.get('boundedBy');

            firstGeoObject.options.set('preset', 'islands#darkBlueDotIconWithCaption');
            // ???????????????? ???????????? ?? ?????????????? ?? ?????????????? ?? ???????????? ????????????????????.
            firstGeoObject.properties.set('iconCaption', firstGeoObject.getAddressLine());

            // ?????????????????? ???????????? ?????????????????? ?????????????????? ???? ??????????.
            myMap.geoObjects.add(firstGeoObject);
            // ???????????????????????? ?????????? ???? ?????????????? ?????????????????? ????????????????????.
            myMap.setBounds(bounds, {
                // ?????????????????? ?????????????? ???????????? ???? ???????????? ????????????????.
                checkZoomRange: true
            });

            /**
             * ?????? ???????????? ?? ???????? javascript-??????????????.
             */
            console.log('?????? ???????????? ????????????????????: ', firstGeoObject.properties.getAll());
            /**
             * ???????????????????? ?????????????? ?? ???????????? ??????????????????.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderResponseMetaData.xml
             */
            console.log('???????????????????? ???????????? ??????????????????: ', res.metaData);
            /**
             * ???????????????????? ??????????????????, ???????????????????????? ?????? ???????????????????? ??????????????.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderMetaData.xml
             */
            console.log('???????????????????? ??????????????????: ', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData'));
            /**
             * ???????????????? ???????????? (precision) ???????????????????????? ???????????? ?????? ??????????.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/precision.xml
             */
            console.log('precision', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.precision'));
            /**
             * ?????? ???????????????????? ?????????????? (kind).
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/kind.xml
             */
            console.log('?????? ????????????????????: %s', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.kind'));
            console.log('???????????????? ??????????????: %s', firstGeoObject.properties.get('name'));
            console.log('???????????????? ??????????????: %s', firstGeoObject.properties.get('description'));
            console.log('???????????? ???????????????? ??????????????: %s', firstGeoObject.properties.get('text'));
            /**
            * ???????????? ???????????? ?????? ???????????? ?? ???????????????????????? ????????????????????????????.
            * @see https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeocodeResult-docpage/#getAddressLine
            */
            console.log('\n??????????????????????: %s', firstGeoObject.getCountry());
            console.log('???????????????????? ??????????: %s', firstGeoObject.getLocalities().join(', '));
            console.log('?????????? ??????????????: %s', firstGeoObject.getAddressLine());
            console.log('???????????????????????? ????????????: %s', firstGeoObject.getPremise() || '-');
            console.log('?????????? ????????????: %s', firstGeoObject.getPremiseNumber() || '-');

            /**
             * ???????? ?????????? ???????????????? ???? ?????????????????? ???????????????????? ?????????????????????? ?????????? ???? ???????????? ?????????????? ?? ?????????????????? ????????????, ?????????????? ?????????? ?????????? ???? ?????????????????????? ?????????????????? ?? ?????????????????? ???? ???? ?????????? ???????????? ??????????????????.
             */
            /**
             var myPlacemark = new ymaps.Placemark(coords, {
             iconContent: '?????? ??????????',
             balloonContent: '???????????????????? ???????????? <strong>???????? ??????????</strong>'
             }, {
             preset: 'islands#violetStretchyIcon'
             });

             myMap.geoObjects.add(myPlacemark);
             */
        });
}

    </script>

</x-app-layout>
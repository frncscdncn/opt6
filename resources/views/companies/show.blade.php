@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="d-flex">
                    <h1>
                        <span class="text-muted">Компания</span> {{ $company->name }}
                    </h1>

                    <div class="ms-auto">
                        <a class="btn btn-primary" href="{{ route('workers.index') }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="text-center col-md-4">
                <img class="img-thumbnail" width="100%" src="{{ Storage::url("/images/companies/$company->logo") }}"
                    alt="{{ $company->name }}">
            </div>
            <div class="col-md-8">
                @if ($company->about_company)
                    <p>
                        <strong>О компании:</strong>
                        {{ $company->about_company }}
                    </p>
                @endif
                <p>
                    <strong>Эл. почта:</strong>
                    {{ $company->email }}
                </p>
                <p>
                    <strong>Адрес:</strong>
                    {{ $company->address }}
                </p>
                <p>
                    <strong>Количество сотрудников:</strong>
                    {{ count($company->workers) }}
                </p>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <div id="map" style="width: 100%; height: 377px; border-radius: 0.375rem; overflow: hidden;"></div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    @foreach ($company->workers as $worker)
                        <div class="col-md-6">
                            <div class="card">
                                <img src="{{ Storage::url('images/workers/' . $worker->image) }}" alt="{{ $worker->name }}"
                                    class="card-img-top" style="width: 100%; height: 200px; object-fit: cover">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $worker->name }}</h5>
                                    <p class="card-text">Номер телефона: {{ $worker->phone_number }}</p>
                                    <p class="card-text">Электронная почта: {{ $worker->email }}</p>
                                    <a href="{{ route('workers.show', $worker->id) }}"
                                        class="btn btn-primary">Посмотреть</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <script type="text/javascript">
                ymaps.ready(function() {
                    const myMap = new ymaps.Map('map', {
                        center: [55.751574, 37.573856],
                        zoom: 9
                    });

                    const query = $('#company-address').text();

                    ymaps.geocode(query, {
                        results: 1
                    }).then(function(res) {
                        // Selecting the first result of geocoding.
                        const firstGeoObject = res.geoObjects.get(0);
                        // The coordinates of the geo object.
                        const coords = firstGeoObject.geometry.getCoordinates();
                        // The viewport of the geo object.
                        const bounds = firstGeoObject.properties.get('boundedBy');

                        firstGeoObject.options.set('preset', 'islands#darkBlueDotIconWithCaption');
                        // Getting the address string and displaying it in the geo object icon.
                        firstGeoObject.properties.set('iconCaption', firstGeoObject.getAddressLine());

                        // Adding first found geo object to the map.
                        myMap.geoObjects.add(firstGeoObject);
                        // Scaling the map to the geo object viewport.
                        myMap.setBounds(bounds, {
                            // Checking the availability of tiles at the given zoom level.
                            checkZoomRange: true
                        });

                        /**
                         * To add a placemark with its own styles and balloon content at the coordinates found by the geocoder, create a new placemark at the coordinates of the found placemark and add it to the map in place of the found one.
                         */
                        /**
                         var myPlacemark = new ymaps.Placemark(coords, {
                         iconContent: 'my placemark',
                         balloonContent: 'Content of the <strong>my placemark</strong> balloon'
                         }, {
                         preset: 'islands#violetStretchyIcon'
                         });

                         myMap.geoObjects.add(myPlacemark);
                         */
                    });
                });
            </script>
        </div>
    </div>
@endsection

<properties-list-main-component style="margin-top: -40px" :page="{{ $page }}"
                                :filters="{{ json_encode($filters, JSON_THROW_ON_ERROR) }}"
                                :query-params="{{ json_encode($queryParams, JSON_THROW_ON_ERROR) }}"
                                :maps-key="'{{ $key }}'"
                                :property-type-data="{{ json_encode($propertyTypeData, JSON_THROW_ON_ERROR) }}">
</properties-list-main-component>

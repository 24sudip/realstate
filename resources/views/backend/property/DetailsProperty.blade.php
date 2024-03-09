@extends('admin.AdminDashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property Details</h6>
                    {{-- <p class="text-muted mb-3">Add class</p> --}}
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Property Name</td>
                                    <td><code>{{ $property->property_name }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Status</td>
                                    <td><code>{{ $property->property_status }}</code></td>
                                </tr>
                                <tr>
                                    <td>Lowest Price</td>
                                    <td><code>{{ $property->lowest_price }}</code></td>
                                </tr>
                                <tr>
                                    <td>Maximum Price</td>
                                    <td><code>{{ $property->max_price }}</code></td>
                                </tr>
                                <tr>
                                    <td>Bedrooms</td>
                                    <td><code>{{ $property->bedrooms }}</code></td>
                                </tr>
                                <tr>
                                    <td>Bathrooms</td>
                                    <td><code>{{ $property->bathrooms }}</code></td>
                                </tr>
                                <tr>
                                    <td>Garage</td>
                                    <td><code>{{ $property->garage }}</code></td>
                                </tr>
                                <tr>
                                    <td>Garage Size</td>
                                    <td><code>{{ $property->garage_size }}</code></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><code>{{ $property->address }}</code></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><code>{{ $property->city }}</code></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><code>{{ $property->state }}</code></td>
                                </tr>
                                <tr>
                                    <td>Postal Code</td>
                                    <td><code>{{ $property->postal_code }}</code></td>
                                </tr>
                                <tr>
                                    <td>Main Image</td>
                                    <td><img src="{{ asset('upload/property/thumbnail') }}/{{ $property->property_thumbnail }}" style="width: 111px; height: 75px;"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if ($property->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property Details</h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Property Code</td>
                                    <td><code>{{ $property->property_code }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Size</td>
                                    <td><code>{{ $property->property_size }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Video</td>
                                    <td><code>{{ $property->property_video }}</code></td>
                                </tr>
                                <tr>
                                    <td>Neighborhood</td>
                                    <td><code>{{ $property->neighborhood }}</code></td>
                                </tr>
                                <tr>
                                    <td>Latitude</td>
                                    <td><code>{{ $property->latitude }}</code></td>
                                </tr>
                                <tr>
                                    <td>Longitude</td>
                                    <td><code>{{ $property->longitude }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Type</td>
                                    <td><code>{{ $property['relation_to_type']['type_name'] }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Amenities</td>
                                    <td>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                            @foreach($amenities as $ameni)
                                            <option value="{{ $ameni->id }}" {{ (in_array($ameni->id,$property_amenities)) ? 'selected' : '' }}>{{ $ameni->amenities_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Agent</td>
                                    <td>
                                        @if ($property->agent_id == NULL)
                                         <code>Admin</code>
                                        @else
                                         <code>{{ $property['relation_to_user']['name'] }}</code>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>
                                    <td>{{ $property->short_descrip }}</td>
                                </tr>
                                <tr>
                                    <td>Long Description</td>
                                    <td>{!! $property->long_descrip !!}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        @if ($property->status == 1)
                        <form method="POST" action="{{ route('inactive.property') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $property->id }}">
                            <button type="submit" class="btn btn-primary">Inactive</button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('store.property') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $property->id }}">
                            <button type="submit" class="btn btn-primary">Active</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--========== Start of add multiple class with ajax ==============-->
{{-- <div style="visibility: hidden">
   <div class="whole_extra_item_add" id="whole_extra_item_add">
      <div class="whole_extra_item_delete" id="whole_extra_item_delete">
         <div class="container mt-2">
            <div class="row">

               <div class="form-group col-md-4">
                  <label for="facility_name">Facilities</label>
                  <select name="facility_name[]" id="facility_name" class="form-control">
                        <option value="">Select Facility</option>
                        <option value="Hospital">Hospital</option>
                        <option value="SuperMarket">Super Market</option>
                        <option value="School">School</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Pharmacy">Pharmacy</option>
                        <option value="Airport">Airport</option>
                        <option value="Railways">Railways</option>
                        <option value="Bus Stop">Bus Stop</option>
                        <option value="Beach">Beach</option>
                        <option value="Mall">Mall</option>
                        <option value="Bank">Bank</option>
                  </select>
               </div>
               <div class="form-group col-md-4">
                  <label for="distance">Distance</label>
                  <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
               </div>
               <div class="form-group col-md-4" style="padding-top: 20px">
                  <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                  <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> --}}
@endsection

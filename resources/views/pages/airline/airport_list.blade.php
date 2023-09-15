@extends('layouts.master')
@section('title')
   Airports
@endsection
<style>
    /* Style for the image preview */
    #image-preview img {
        max-width: 200px;
        max-height: 200px;
        margin: 10px;
    }
</style>
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Airline @endslot
        @slot('title')Airports  @endslot 
    @endcomponent

    <div class="row">
        <div class="col-6">
            <div class="card">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                    @endif
            
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                <div class="card-body">
                    <h4 class="card-title mb-3">Add Airport</h4>
                   
                    <form class="needs-validation " novalidate action="{{ route('addRoomTypes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Airport Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Saudi Airlines"
                                         required>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">IATA Code</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Saudi Airlines"
                                         required>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="productname">Country</label>
                                    <select name="country" id="country" class="form-select">
                                        
                                            <option value="" selected="selected">Select Country</option> 
                                            <option value="Afghanistan">Afghanistan</option> 
                                            <option value="Albania">Albania</option> 
                                            <option value="Algeria">Algeria</option> 
                                            <option value="American Samoa">American Samoa</option> 
                                            <option value="Andorra">Andorra</option> 
                                            <option value="Angola">Angola</option> 
                                            <option value="Anguilla">Anguilla</option> 
                                            <option value="Antarctica">Antarctica</option> 
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
                                            <option value="Argentina">Argentina</option> 
                                            <option value="Armenia">Armenia</option> 
                                            <option value="Aruba">Aruba</option> 
                                            <option value="Australia">Australia</option> 
                                            <option value="Austria">Austria</option> 
                                            <option value="Azerbaijan">Azerbaijan</option> 
                                            <option value="Bahamas">Bahamas</option> 
                                            <option value="Bahrain">Bahrain</option> 
                                            <option value="Bangladesh">Bangladesh</option> 
                                            <option value="Barbados">Barbados</option> 
                                            <option value="Belarus">Belarus</option> 
                                            <option value="Belgium">Belgium</option> 
                                            <option value="Belize">Belize</option> 
                                            <option value="Benin">Benin</option> 
                                            <option value="Bermuda">Bermuda</option> 
                                            <option value="Bhutan">Bhutan</option> 
                                            <option value="Bolivia">Bolivia</option> 
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
                                            <option value="Botswana">Botswana</option> 
                                            <option value="Bouvet Island">Bouvet Island</option> 
                                            <option value="Brazil">Brazil</option> 
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
                                            <option value="Brunei Darussalam">Brunei Darussalam</option> 
                                            <option value="Bulgaria">Bulgaria</option> 
                                            <option value="Burkina Faso">Burkina Faso</option> 
                                            <option value="Burundi">Burundi</option> 
                                            <option value="Cambodia">Cambodia</option> 
                                            <option value="Cameroon">Cameroon</option> 
                                            <option value="Canada">Canada</option> 
                                            <option value="Cape Verde">Cape Verde</option> 
                                            <option value="Cayman Islands">Cayman Islands</option> 
                                            <option value="Central African Republic">Central African Republic</option> 
                                            <option value="Chad">Chad</option> 
                                            <option value="Chile">Chile</option> 
                                            <option value="China">China</option> 
                                            <option value="Christmas Island">Christmas Island</option> 
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
                                            <option value="Colombia">Colombia</option> 
                                            <option value="Comoros">Comoros</option> 
                                            <option value="Congo">Congo</option> 
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
                                            <option value="Cook Islands">Cook Islands</option> 
                                            <option value="Costa Rica">Costa Rica</option> 
                                            <option value="Cote D'ivoire">Cote D'ivoire</option> 
                                            <option value="Croatia">Croatia</option> 
                                            <option value="Cuba">Cuba</option> 
                                            <option value="Cyprus">Cyprus</option> 
                                            <option value="Czech Republic">Czech Republic</option> 
                                            <option value="Denmark">Denmark</option> 
                                            <option value="Djibouti">Djibouti</option> 
                                            <option value="Dominica">Dominica</option> 
                                            <option value="Dominican Republic">Dominican Republic</option> 
                                            <option value="Ecuador">Ecuador</option> 
                                            <option value="Egypt">Egypt</option> 
                                            <option value="El Salvador">El Salvador</option> 
                                            <option value="Equatorial Guinea">Equatorial Guinea</option> 
                                            <option value="Eritrea">Eritrea</option> 
                                            <option value="Estonia">Estonia</option> 
                                            <option value="Ethiopia">Ethiopia</option> 
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
                                            <option value="Faroe Islands">Faroe Islands</option> 
                                            <option value="Fiji">Fiji</option> 
                                            <option value="Finland">Finland</option> 
                                            <option value="France">France</option> 
                                            <option value="French Guiana">French Guiana</option> 
                                            <option value="French Polynesia">French Polynesia</option> 
                                            <option value="French Southern Territories">French Southern Territories</option> 
                                            <option value="Gabon">Gabon</option> 
                                            <option value="Gambia">Gambia</option> 
                                            <option value="Georgia">Georgia</option> 
                                            <option value="Germany">Germany</option> 
                                            <option value="Ghana">Ghana</option> 
                                            <option value="Gibraltar">Gibraltar</option> 
                                            <option value="Greece">Greece</option> 
                                            <option value="Greenland">Greenland</option> 
                                            <option value="Grenada">Grenada</option> 
                                            <option value="Guadeloupe">Guadeloupe</option> 
                                            <option value="Guam">Guam</option> 
                                            <option value="Guatemala">Guatemala</option> 
                                            <option value="Guinea">Guinea</option> 
                                            <option value="Guinea-bissau">Guinea-bissau</option> 
                                            <option value="Guyana">Guyana</option> 
                                            <option value="Haiti">Haiti</option> 
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
                                            <option value="Honduras">Honduras</option> 
                                            <option value="Hong Kong">Hong Kong</option> 
                                            <option value="Hungary">Hungary</option> 
                                            <option value="Iceland">Iceland</option> 
                                            <option value="India">India</option> 
                                            <option value="Indonesia">Indonesia</option> 
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
                                            <option value="Iraq">Iraq</option> 
                                            <option value="Ireland">Ireland</option> 
                                            <option value="Israel">Israel</option> 
                                            <option value="Italy">Italy</option> 
                                            <option value="Jamaica">Jamaica</option> 
                                            <option value="Japan">Japan</option> 
                                            <option value="Jordan">Jordan</option> 
                                            <option value="Kazakhstan">Kazakhstan</option> 
                                            <option value="Kenya">Kenya</option> 
                                            <option value="Kiribati">Kiribati</option> 
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
                                            <option value="Korea, Republic of">Korea, Republic of</option> 
                                            <option value="Kuwait">Kuwait</option> 
                                            <option value="Kyrgyzstan">Kyrgyzstan</option> 
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
                                            <option value="Latvia">Latvia</option> 
                                            <option value="Lebanon">Lebanon</option> 
                                            <option value="Lesotho">Lesotho</option> 
                                            <option value="Liberia">Liberia</option> 
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
                                            <option value="Liechtenstein">Liechtenstein</option> 
                                            <option value="Lithuania">Lithuania</option> 
                                            <option value="Luxembourg">Luxembourg</option> 
                                            <option value="Macao">Macao</option> 
                                            <option value="North Macedonia">North Macedonia</option> 
                                            <option value="Madagascar">Madagascar</option> 
                                            <option value="Malawi">Malawi</option> 
                                            <option value="Malaysia">Malaysia</option> 
                                            <option value="Maldives">Maldives</option> 
                                            <option value="Mali">Mali</option> 
                                            <option value="Malta">Malta</option> 
                                            <option value="Marshall Islands">Marshall Islands</option> 
                                            <option value="Martinique">Martinique</option> 
                                            <option value="Mauritania">Mauritania</option> 
                                            <option value="Mauritius">Mauritius</option> 
                                            <option value="Mayotte">Mayotte</option> 
                                            <option value="Mexico">Mexico</option> 
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
                                            <option value="Moldova, Republic of">Moldova, Republic of</option> 
                                            <option value="Monaco">Monaco</option> 
                                            <option value="Mongolia">Mongolia</option> 
                                            <option value="Montserrat">Montserrat</option> 
                                            <option value="Morocco">Morocco</option> 
                                            <option value="Mozambique">Mozambique</option> 
                                            <option value="Myanmar">Myanmar</option> 
                                            <option value="Namibia">Namibia</option> 
                                            <option value="Nauru">Nauru</option> 
                                            <option value="Nepal">Nepal</option> 
                                            <option value="Netherlands">Netherlands</option> 
                                            <option value="Netherlands Antilles">Netherlands Antilles</option> 
                                            <option value="New Caledonia">New Caledonia</option> 
                                            <option value="New Zealand">New Zealand</option> 
                                            <option value="Nicaragua">Nicaragua</option> 
                                            <option value="Niger">Niger</option> 
                                            <option value="Nigeria">Nigeria</option> 
                                            <option value="Niue">Niue</option> 
                                            <option value="Norfolk Island">Norfolk Island</option> 
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
                                            <option value="Norway">Norway</option> 
                                            <option value="Oman">Oman</option> 
                                            <option value="Pakistan">Pakistan</option> 
                                            <option value="Palau">Palau</option> 
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
                                            <option value="Panama">Panama</option> 
                                            <option value="Papua New Guinea">Papua New Guinea</option> 
                                            <option value="Paraguay">Paraguay</option> 
                                            <option value="Peru">Peru</option> 
                                            <option value="Philippines">Philippines</option> 
                                            <option value="Pitcairn">Pitcairn</option> 
                                            <option value="Poland">Poland</option> 
                                            <option value="Portugal">Portugal</option> 
                                            <option value="Puerto Rico">Puerto Rico</option> 
                                            <option value="Qatar">Qatar</option> 
                                            <option value="Reunion">Reunion</option> 
                                            <option value="Romania">Romania</option> 
                                            <option value="Russian Federation">Russian Federation</option> 
                                            <option value="Rwanda">Rwanda</option> 
                                            <option value="Saint Helena">Saint Helena</option> 
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                            <option value="Saint Lucia">Saint Lucia</option> 
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
                                            <option value="Samoa">Samoa</option> 
                                            <option value="San Marino">San Marino</option> 
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                            <option value="Saudi Arabia">Saudi Arabia</option> 
                                            <option value="Senegal">Senegal</option> 
                                            <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
                                            <option value="Seychelles">Seychelles</option> 
                                            <option value="Sierra Leone">Sierra Leone</option> 
                                            <option value="Singapore">Singapore</option> 
                                            <option value="Slovakia">Slovakia</option> 
                                            <option value="Slovenia">Slovenia</option> 
                                            <option value="Solomon Islands">Solomon Islands</option> 
                                            <option value="Somalia">Somalia</option> 
                                            <option value="South Africa">South Africa</option> 
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
                                            <option value="Spain">Spain</option> 
                                            <option value="Sri Lanka">Sri Lanka</option> 
                                            <option value="Sudan">Sudan</option> 
                                            <option value="Suriname">Suriname</option> 
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
                                            <option value="Swaziland">Swaziland</option> 
                                            <option value="Sweden">Sweden</option> 
                                            <option value="Switzerland">Switzerland</option> 
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
                                            <option value="Tajikistan">Tajikistan</option> 
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
                                            <option value="Thailand">Thailand</option> 
                                            <option value="Timor-leste">Timor-leste</option> 
                                            <option value="Togo">Togo</option> 
                                            <option value="Tokelau">Tokelau</option> 
                                            <option value="Tonga">Tonga</option> 
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
                                            <option value="Tunisia">Tunisia</option> 
                                            <option value="Turkey">Turkey</option> 
                                            <option value="Turkmenistan">Turkmenistan</option> 
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
                                            <option value="Tuvalu">Tuvalu</option> 
                                            <option value="Uganda">Uganda</option> 
                                            <option value="Ukraine">Ukraine</option> 
                                            <option value="United Arab Emirates">United Arab Emirates</option> 
                                            <option value="United Kingdom">United Kingdom</option> 
                                            <option value="United States">United States</option> 
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
                                            <option value="Uruguay">Uruguay</option> 
                                            <option value="Uzbekistan">Uzbekistan</option> 
                                            <option value="Vanuatu">Vanuatu</option> 
                                            <option value="Venezuela">Venezuela</option> 
                                            <option value="Viet Nam">Viet Nam</option> 
                                            <option value="Virgin Islands, British">Virgin Islands, British</option> 
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
                                            <option value="Wallis and Futuna">Wallis and Futuna</option> 
                                            <option value="Western Sahara">Western Sahara</option> 
                                            <option value="Yemen">Yemen</option> 
                                            <option value="Zambia">Zambia</option> 
                                            <option value="Zimbabwe">Zimbabwe</option>

                                    </select>
                                </div>
                            </div>
    
                        </div>

                        <button class="btn btn-primary" type="submit">Add Airline Provider</button>
                    </form>
                   
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Airline Providers</h4>
                   
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>Airport Name</th>
                                    <th>Code</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($airportLocations as $index => $airport)
                                <tr data-id="{{ $index + 1 }}">
                                    <td >{{ $airport->airport_name }}</td>
                                    <td >{{ $airport->iata_code }}</td>
                                    <td >{{ $airport->country }}</td>
                                    <td style="width: 100px">
                                        {{-- <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $room_type->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                          </button> --}}
                                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delteModal{{ $airport->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                          </button>
                                        
                                    </td>
                                </tr>
                                <div class="modal fade" id="delteModal{{ $airport->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Delete Room Type</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                
                                         Are You Sure You Want To Delete This.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <form action="{{ route('deleteRoomType', ['id' => $airport->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Yes</button>
                                          </form>
                
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                {{-- <div class="modal fade bs-example-modal-lg" id="editModal{{ $provider->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Room Types</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample" action="{{ route('updateRoomType') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="type_id" value="{{ $provider->id }}">
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                          <div class="mb-3">
                                                              <label for="editBrandCode" class="form-label">Room Type</label>
                                                              <input type="text" name="room_type_name" class="form-control" id="editBrandCode" value="{{ $room_type->room_type_name }}" required>
                                                          </div>
                                                          <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="mb-3">
                                                              <label for="editBrandName" class="form-label">Room Type Code</label>
                                                              <input type="text" name="room_type_code" class="form-control" id="editBrandName" value="{{ $room_type->room_type_code }}" required>
                                                          </div>
                                                          <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                      </div>
                                                  </div>
                                                  <div class="mb-3">
                                                      <label  for="validationCustom03" class="form-label">Description</label>
                                                      <textarea class="form-control" name="description" id="validationCustom03" rows="3" placeholder="RoomType Description" required>{{ $room_type->description }}</textarea>
                                                      <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                  </div>
                                                  <label class="form-label" for="editBrandLogo">Current Images</label>
                                                     <div class="mb-3">
                                                      
                                                      @foreach (json_decode($room_type->images) as $image)
                                                      <img src="{{ asset('storage/' .$image) }}" alt="Image" class="img-thumbnail"  style="max-width: 200px; max-height: 150px;">
                                                      @endforeach
                                                  </div> 
                  
                                                   <div class="mb-3">
                                                      <label class="form-label" for="editNewBrandLogo">Upload New Images</label>
                                                      <div class="mb-3">
                                                        <input type="file" class="form-control" name="files[]" id="files" multiple accept=".jpeg, .jpg, .png, .gif">
                                                    </div>
                                                    <div id="image-preview"></div>
                                                  </div>
                                               
                                                    <button type="submit" class="btn btn-primary">Update Changes</button>
                  
                                                    <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
       
    </div> <!-- end row -->

@endsection
@section('script')
<script>
    document.getElementById('images').addEventListener('change', function (event) {
        var imagePreviews = document.getElementById('image-previews');
        imagePreviews.innerHTML = ''; // Clear existing previews

        for (var i = 0; i < event.target.files.length; i++) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.className = 'img-thumbnail mr-2 mb-2';
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            imagePreviews.appendChild(img);
        }
    });
</script>
<script>
    document.getElementById('files').addEventListener('change', function (event) {
        var imagePreviews = document.getElementById('image-preview');
        imagePreviews.innerHTML = ''; // Clear existing previews

        for (var i = 0; i < event.target.files.length; i++) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.className = 'img-thumbnail mr-2 mb-2';
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            imagePreviews.appendChild(img);
        }
    });
</script>


    <script src="{{ URL::asset('/assets/libs/table-edits/table-edits.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/table-editable.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    
@endsection

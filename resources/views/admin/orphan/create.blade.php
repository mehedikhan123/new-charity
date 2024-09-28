@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>{{ isset($orphan) ? 'Edit' : 'Create' }} Orphan</h1>
            <div>
                <a href="{{ route('admin.orphans.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($orphan) ? route('admin.orphans.update', $orphan->id) : route('admin.orphans.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($orphan)
                                    @method('put')
                                @endisset
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter your name" value="{{ isset($orphan) ? $orphan->name : old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="date_of_birth">Date of birth <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Please enter your date of birth" value="{{ isset($orphan) ? $orphan->date_of_birth : old('date_of_birth') }}">
                                            @if ($errors->has('date_of_birth'))
                                                <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="age">Age <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="age" id="age" placeholder="Please enter your age" value="{{ isset($orphan) ? $orphan->age : old('age') }}">
                                            @if ($errors->has('age'))
                                                <span class="text-danger">{{ $errors->first('age') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="gender">Gender <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-select">
                                                <option value="">Please select your gender</option>
                                                <option value="male" @if(isset($orphan) && $orphan->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if(isset($orphan) && $orphan->gender == 'female') selected @endif>Female</option>
                                                <option value="others" @if(isset($orphan) && $orphan->gender == 'others') selected @endif>Others</option>
                                            </select>
                                            @if ($errors->has('gender'))
                                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="economic_status">Economic status <span class="text-danger">*</span></label>
                                            <select name="economic_status" id="economic_status" class="form-select">
                                                <option value="">Please select your economic status</option>
                                                <option value="orphan" @if(isset($orphan) && $orphan->economic_status == 'orphan') selected @endif>Orphan</option>
                                                <option value="ultra poor" @if(isset($orphan) && $orphan->economic_status == 'ultra poor') selected @endif>Ultra Poor</option>
                                                <option value="street children" @if(isset($orphan) &&$orphan->economic_status == 'street children') selected @endif>Street Children</option>
                                            </select>
                                            @if ($errors->has('economic_status'))
                                                <span class="text-danger">{{ $errors->first('economic_status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="support_type">Support type <span class="text-danger">*</span></label>
                                            <select name="support_type" id="support_type" class="form-select">
                                                <option value="">Please select your support type</option>
                                                <option value="food" @if(isset($orphan) && $orphan->support_type == 'food') selected @endif>Food</option>
                                                <option value="cloths" @if(isset($orphan) && $orphan->support_type == 'cloths') selected @endif>Cloths</option>
                                                <option value="home" @if(isset($orphan) && $orphan->support_type == 'home') selected @endif>Home</option>
                                                <option value="education" @if(isset($orphan) && $orphan->support_type == 'education') selected @endif>Education</option>
                                                <option value="medication" @if(isset($orphan) && $orphan->support_type == 'medication') selected @endif>Medication</option>
                                            </select>
                                            @if ($errors->has('support_type'))
                                                <span class="text-danger">{{ $errors->first('support_type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="mobile_number">Mobile number <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="mobile_number" id="mobile_number" placeholder="Please enter your mobile number" value="{{ isset($orphan) ? $orphan->mobile_number : old('mobile_number') }}">
                                            @if ($errors->has('mobile_number'))
                                                <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email_address">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Please enter your email address" value="{{ isset($orphan) ? $orphan->email_address : old('email_address') }}">
                                            @if ($errors->has('email_address'))
                                                <span class="text-danger">{{ $errors->first('email_address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="guardian_name">Guardian name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="guardian_name" id="guardian_name" placeholder="Please enter your guardian name" value="{{ isset($orphan) ? $orphan->guardian_name : old('guardian_name') }}">
                                            @if ($errors->has('guardian_name'))
                                                <span class="text-danger">{{ $errors->first('guardian_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="relationship_with_guardian">Relationship with guardian <span class="text-danger">*</span></label>
                                            <select name="relationship_with_guardian" id="relationship_with_guardian" class="form-select">
                                                <option value="">Please select your relationship with guardian</option>
                                                <option value="father" @if(isset($orphan) && $orphan->relationship_with_guardian == 'father') selected @endif>Father</option>
                                                <option value="mother" @if(isset($orphan) && $orphan->relationship_with_guardian == 'mother') selected @endif>Mother</option>
                                                <option value="brother" @if(isset($orphan) && $orphan->relationship_with_guardian == 'brother') selected @endif>Brother</option>
                                                <option value="sister" @if(isset($orphan) && $orphan->relationship_with_guardian == 'sister') selected @endif>Sister</option>
                                                <option value="paternal grandfather" @if(isset($orphan) && $orphan->relationship_with_guardian == 'paternal grandfather') selected @endif>Paternal grandfather</option>
                                                <option value="maternal grandfather" @if(isset($orphan) &&  $orphan->relationship_with_guardian == 'maternal grandfather') selected @endif>Maternal grandfather</option>
                                                <option value="paternal grandmother" @if(isset($orphan) && $orphan->relationship_with_guardian == 'paternal grandmother') selected @endif>Paternal grandmother</option>
                                                <option value="maternal grandmother" @if(isset($orphan) && $orphan->relationship_with_guardian == 'maternal grandmother') selected @endif>Maternal grandmother</option>
                                                <option value="paternal uncle" @if(isset($orphan) && $orphan->relationship_with_guardian == 'paternal uncle') selected @endif>Paternal uncle</option>
                                                <option value="maternal uncle" @if(isset($orphan) && $orphan->relationship_with_guardian == 'maternal uncle') selected @endif>Maternal uncle</option>
                                                <option value="paternal uncle" @if(isset($orphan) && $orphan->relationship_with_guardian == 'paternal uncle') selected @endif>Paternal uncle</option>
                                                <option value="maternal uncle" @if(isset($orphan) && $orphan->relationship_with_guardian == 'maternal uncle') selected @endif>Maternal uncle</option>
                                                <option value="paternal aunty" @if(isset($orphan) && $orphan->relationship_with_guardian == 'paternal aunty') selected @endif>Paternal aunty</option>
                                                <option value="maternal aunty" @if(isset($orphan) && $orphan->relationship_with_guardian == 'maternal aunty') selected @endif>Maternal aunty</option>
                                                <option value="caregiver" @if(isset($orphan) && $orphan->relationship_with_guardian == 'caregiver') selected @endif>Caregiver</option>
                                            </select>
                                            @if ($errors->has('relationship_with_guardian'))
                                                <span class="text-danger">{{ $errors->first('relationship_with_guardian') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="village_city">Village / City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="village_city" id="village_city" placeholder="Please enter your village / city" value="{{ isset($orphan) ? $orphan->village_city : old('village_city') }}">
                                            @if ($errors->has('village_city'))
                                                <span class="text-danger">{{ $errors->first('village_city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="division">Division <span class="text-danger">*</span></label>
                                            <select name="division" id="division" class="form-select" onchange="changeDivision(event)">
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" @if(isset($orphan) &&  $orphan->division == $division->id) selected @endif>{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('division'))
                                                <span class="text-danger">{{ $errors->first('division') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="district">District <span class="text-danger">*</span></label>
                                            <select name="district" id="district" class="form-select" onchange="changeDistrict(event)">
                                                <option value="">Select District</option>
                                            </select>
                                            @if ($errors->has('district'))
                                                <span class="text-danger">{{ $errors->first('district') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="upazila">Upazila <span class="text-danger">*</span></label>
                                            <select name="upazila" id="upazila" class="form-select">
                                                <option value="">Select Upazila</option>
                                            </select>
                                            @if ($errors->has('upazila'))
                                                <span class="text-danger">{{ $errors->first('upazila') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @isset($orphan->photo)
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('storage/uploads/photo/'.$orphan->photo) }}" alt="" class="w_200">
                                        </div>
                                    </div>
                                @endisset

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label>{{ isset($orphan->photo) ? 'Change Photo' : 'Photo'}} <span class="text-danger">*</span></label>
                                        <div>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                        @if ($errors->has('photo'))
                                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="description">Short Description</label>
                                        <textarea name="description" class="form-control h_100" cols="30" rows="10" placeholder="Please enter a short description">{{ isset($orphan) ? $orphan->description : old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="reported_by">Reported by <span class="text-danger">*</span></label>
                                        <select name="reported_by" id="reported_by" class="form-select">
                                            <option value="">Select reported by</option>
                                            @foreach ($volunteers as $volunteer)
                                                <option value="{{ $volunteer->id }}" @if(isset($orphan) &&  $orphan->reported_by == $volunteer->id) selected @endif>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('reported_by'))
                                            <span class="text-danger">{{ $errors->first('reported_by') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ isset($orphan->id) ? 'Update' : 'Submit' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
    <script type="text/javascript">
        const selectedDistrict = @json($orphan->district ?? null);
        const selectedUpazila = @json($orphan->upazila ?? null);
        // console.log(selectedDistrict);

        let divisions = @json($divisions);
        let districts = @json($districts);
        let upazilas = @json($upazilas);

        // Trigger division change to populate district dropdown
        let divisionSelect = document.getElementById('division');
        if (divisionSelect.value) {
            changeDivision({ target: divisionSelect }, function() {
                // Trigger district change to populate upazila dropdown
                let districtSelect = document.getElementById('district');
                if (districtSelect.value) {
                    changeDistrict({ target: districtSelect });
                }
            });
        }


        function changeDivision(event) {
            const divisionId = event.target.value;
            const districtSelect = document.getElementById('district');
            const upazilaSelect = document.getElementById('upazila');

            districtSelect.innerHTML = '<option value="">Select District</option>';
            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';

            if (divisionId) {
                const filteredDistricts = districts.filter(district => district.division_id == divisionId);
                filteredDistricts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.id;
                    option.text = district.name;
                    districtSelect.add(option);
                });

                // Set selected district if exists
                if (selectedDistrict) {
                    districtSelect.value = selectedDistrict;
                    changeDistrict({ target: districtSelect });
                }
            }
        }

        function changeDistrict(event) {
            var districtId = event.target.value;
            var upazilaSelect = document.getElementById('upazila');

            upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';

            if (districtId) {
                var filteredUpazilas = upazilas.filter(upazila => upazila.district_id == districtId);
                filteredUpazilas.forEach(upazila => {
                    var option = document.createElement('option');
                    option.value = upazila.id;
                    option.text = upazila.name;
                    upazilaSelect.add(option);
                });
                // Set selected upazila if exists
                if (selectedUpazila) {
                    upazilaSelect.value = selectedUpazila;
                }
            }
        }
    </script>
@endpush

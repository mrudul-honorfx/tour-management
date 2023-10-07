@extends('layouts.master')
@section('title')
    @lang('translation.Starter_Page')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Bank @endslot
        @slot('title') Bank Details @endslot
    @endcomponent
    <div class="section">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Add Bank Details</h4>
                        <form method="POST" action="{{ route('addBankDetails') }}">
                            @csrf
                            <div class="row mb-4">
                                <label for="horizontal-Fullname-input" class="col-sm-3 col-form-label">Bank Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='bank_name' id="horizontal-Fullname-input" placeholder="Enter Bank Name">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Account Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="account_name" class="form-control" id="horizontal-email-input" placeholder="Enter Account Name">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Branch</label>
                                <div class="col-sm-9">
                                    <input type="text" name="branch" class="form-control" id="horizontal-email-input" placeholder="Enter Branch Name">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Account Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="account_number" class="form-control" id="horizontal-email-input" placeholder="Enter Account Number">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">IBAN Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="iban_number" class="form-control" id="horizontal-email-input" placeholder="Enter IBAN Number">
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div class="d-flex flex-wrap gap-3">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button>
                                        {{-- <button type="reset" class="btn btn-outline-danger waves-effect waves-light w-md">Reset</button> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body overflow-auto" style="max-height:700px;">
                        <h4 class="card-title mb-3">Bank Details</h4>
                        {{-- table designed like a card with a toggle button on the header --}}
                        {{-- check if allBankDetails is empty --}}
                        @if (count($allBankDetails) == 0)
                        <div class="card border border-danger">
                            <div class="card-body text-center">
                                <h5 class="card-title mt-0">No Bank Details Found</h5>
                                <p class="card-text">Add bank details using the form</p>
                            </div>
                        </div>
                        @else
                            @foreach($allBankDetails as $bankDetails)
                                <div class="card border border-secondary">
                                    <div class="card-header bg-transparent border-secondary">
                                        <div class="form-check form-switch form-switch-md float-end d-flex align-items-center gap-2">
                                            <input type="checkbox" class="form-check-input" {{$bankDetails->status == 1?'checked':''}} name="toggleStatus" id="customSwitchsizemd" onclick="toggleAddress({{$bankDetails->id}})">
                                            <button type="button" class="btn btn-outline-danger waves-effect waves-light" onclick="deleteBankDetail({{$bankDetails->id}})"><i class="uil-trash-alt"></i></button>
                                        </div>
                                        <h5 class="my-0 text-secondary">{{$bankDetails->bank_name}}</h5>
                                    </div>
                                    <div class="card-body grid">
                                        <p class="card-text m-0">Account Name: <span class="text-secondary">{{$bankDetails->bank_name}}</span></p>
                                        <p class="card-text m-0">Branch: <span class="text-secondary">{{$bankDetails->account_name}}</span></p>
                                        <p class="card-text m-0">Account Number: <span class="text-secondary">{{$bankDetails->account_number}}</span></p>
                                        <p class="card-text m-0">IBAN Number: <span class="text-secondary">{{$bankDetails->iban_number}}</span></p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- jquery function to get call the toggleBankStatus() on click --}}
    <script>
        function toggleAddress(id) {
            console.log(id);
            $.ajax({
                url: '/bank/toggleBankStatus',
                type: 'POST',
                data: {
                    bank_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 1) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
        function deleteBankDetail(id) {
            console.log(id);
            $.ajax({
                url: '/bank/deleteBankStatus',
                type: 'POST',
                data: {
                    bank_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 1) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endsection

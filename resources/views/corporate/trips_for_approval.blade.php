@extends("layouts.corporate_admin")
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
@endpush
@section("content")
    <corporate-trips-for-approval
            p-corporate-trip-master="{{$CorporateTripMaster}}"
            p-employee-family-members="{{$FamilyMembersList}}"
            p-approver-work-flow-list="{{$ApproverWorkFlowList}}"
            p-coporate-trip-reason-list="{{$CoporateTripReasonList}}">
    </corporate-trips-for-approval>
@endsection

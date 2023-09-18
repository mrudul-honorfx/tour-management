@php
    // Parse the tour_start_date and tour_end_date as Carbon objects
    $startDate = \Carbon\Carbon::parse($airline->departure_date_time);
    $endDate = \Carbon\Carbon::parse($airline->arrival_date_time);

    // Calculate the time difference
    $timeDifference = $startDate->diff($endDate);

    // Get the hours and minutes
    $hours = $timeDifference->format('%h');
    $minutes = $timeDifference->format('%i');

    // Format the dates as "day Month" (e.g., "17 Aug")
    $formattedStartDate = $startDate->format('d M');
    $formattedStartTime = $startDate->format('h:i A');
    $formattedEndDate = $endDate->format('d M');
    $formattedEndTime = $endDate->format('h:i A');
@endphp

<div>
    <div class="card mb-3">
        <div class="card-header">
          <h5 class="m-0"><span class="text-muted mr-2"><i class="fa fa-plane"></i></span>Departing of Flight</h5>
        </div>
        <div class="card-body">
          <div class="row mt-n3">
            <div class="col-sm-4 mt-3"> <span>Date:</span>
              <p class="font-weight-600 mb-0">{{$formattedStartDate}}</p>
            </div>
            <div class="col-sm-4 mt-3"> <span>Departure Time:</span>
              <p class="font-weight-600 mb-0">{{ $formattedStartTime}}</p>
            </div>
            <div class="col-sm-4 mt-3"> <span>Airline:</span>
              <p class="font-weight-600 mb-0">{{$airline->airline_name}}</p>
            </div>
            <div class="col-sm-4 mt-3"> <span>Confirm Code:</span>
              <p class="font-weight-600 mb-0">{{$airline->pnr}}</p>
            </div>
            <div class="col-sm-4 mt-3"> <span>Departure:</span>
              <p class="font-weight-600 mb-0">{{$airline->departure_destination_name}}</p>
            </div>
            <div class="col-sm-4 mt-3"> <span>Arrival</span>
              <p class="font-weight-600 mb-0">{{$airline->arrival_destination_name}}</p>
            </div>
            <div class="col-sm-4 mt-3"> <span>Arrival Date</span>
                <p class="font-weight-600 mb-0">{{$formattedEndDate}}</p>
            </div>
            <div class="col-sm-4 mt-3"> <span>Arrival Time</span>
                <p class="font-weight-600 mb-0">{{$formattedEndTime}}</p>
            </div>
            <div class="col-sm-4 mt-3"> <span>Duration</span>
                <p class="font-weight-600 mb-0">{{$hours}}Hr {{$minutes}}m</p>
            </div>
          </div>
        </div>
      </div>
</div>

<style scoped>
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
}
.m-0 {
    margin: 0!important;
}
.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}
.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.col-sm-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

.font-weight-600 {
    font-weight: 600 !important;
}
.mb-3{
    margin-bottom: 1rem !important;
}
</style>

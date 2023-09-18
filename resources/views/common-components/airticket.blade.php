
<div class="row">
        <div class="flights">
            <section class="flights-list">
                    @foreach ($packageAirline as $airline)

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
                    <article class="flight-card flights-list__item">
                        {{-- <div class="flight-card__airlines">
                            <div class="flight-card__airline">
                                <img src="https://flagcdn.com/256x192/ua.png" alt="" height="50"
                                class="logo">
                            </div>
                            <!-- /.flight-card__airline -->
                            <div class="flight-card__airline">
                                <img src="//unsplash.it/30/30" alt="">
                            </div>
                            <!-- /.flight-card__airline -->
                        </div> --}}
                        <!-- /.flight-card__airlines -->
                        <div class="flight-card__departure">
                            <time class="flight-card__time">{{$formattedStartTime}}</time>
                            <h2 class="flight-card__city"> {{$airline->departure_destination_name}}</h2>
                            <time class="flight-card__day">{{$formattedStartDate}}</time>
                        </div>
                        <!-- /.flight-card__departure -->
                        <div class="flight-card__route">
                            <p class="flight-card__duration">{{$hours}}hr {{$minutes}}m</p>
                            <div class="flight-card__route-line route-line" aria-hidden="true">
                                <div class="route-line__stop route-line__start" aria-hidden="true"></div>
                                <!-- /.route-line__start -->
                                <div class="route-line__stop route-line__end" aria-hidden="true"></div>
                                <!-- /.route-line__start -->
                            </div>
                            <!-- flight-card__route-line -->
                            <p class="flight-card__type">Non-stop</p>
                        </div>
                        <div class="flight-card__arrival">
                            <time class="flight-card__time">{{$formattedEndTime}}</time>
                            <h2 class="flight-card__city">{{$airline->arrival_destination_name}}</h2>
                            <time class="flight-card__day">{{$formattedEndDate}}</time>
                        </div>
                        <!-- /.flight-card__arrival -->
                        <div class="flight-card__action text-center">
                            <img src="{{ asset('/assets/images/airlines/' . Illuminate\Support\Str::lower($airline->code) . '.png') }}" alt="" height="50" class="logo m-auto">
                            <p class="flight-card__city pt-2 font-size-16"><strong>{{$airline->flight_number}}</strong><br>
                                <strong>{{$airline->pnr}}</strong></p>
                        </div>
                        <!-- /.flight-card__action -->
                    </article>
                    @endforeach
              <!-- /.flight-card -->
            </section>

        </div>
    </div>
<style scoped>
:root {
  --color-off-white: 240, 18%, 97%;
  --color-purple: 239, 39%, 45%;
  --color-light-purple: 240, 52%, 94%;
  --color-orange: 13, 94%, 66%;
  --color-dark-orange: 13, 94%, 46%;
  --font-weight-normal: 400;
  --font-weight-medium: 600;
  --font-weight-bold: 700;
  --ease-out-quart: cubic-bezier(0.25, 1, 0.5, 1);
}
 html{
    box-sizing:border-box;
    
}
*,::after,::before{
    box-sizing:inherit
}
body{
    background-color:HSL(var(--color-off-white))
}

img{
    display:block;
    max-width:100%
}
.route-line{
    position:relative;
    margin:1rem 0 0;
    width:100%;
    height:1px;
    border:.1rem dashed HSL(var(--color-purple))
}
.route-line__stop{
    border-radius:100%;
    box-sizing:content-box;
    width:.8rem;
    height:.8rem;
    position:absolute;
    top:50%;
    background-color:HSL(var(--color-purple));
    transform:translate3d(-50%,-50%,0)
}
.route-line__stop-name{
    margin-top:1.5rem;
    font-size:1rem;
    transform:translateX(-.7rem)
}
.route-line__start{
    left:0;
    border:.6rem solid HSL(var(--color-purple));
    background-color:#fff
}
.route-line__end{
    right:0;
    border:.6rem solid HSL(var(--color-light-purple));
    transform:translate3d(50%,-50%,0)
}
.flights-list__item:not(:last-child){
    margin-bottom:2.5rem
}
.flight-card{
    border-radius:1.5rem;
    box-shadow:0 0 .1rem HSLA(var(--color-purple),.1);
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:1.5rem;
    background-color:#faf9f6
}
.flight-card__airline{
    border-radius:100%;
    overflow:hidden;
    flex:0 1 5rem;
    border:.2rem solid #fff
}
.flight-card__airline+.flight-card__airline{
    position:relative;
    top:-1.5rem
}
.flight-card__departure{
    margin-left:2rem
}
.flight-card__arrival{
    margin-right:3rem;
    text-align:right
}
.flight-card__route{
    display:flex;
    flex-direction:column;
    flex:1 0 auto;
    justify-content:center;
    align-items:center;
    padding:0 4rem
}
.flight-card__duration,.flight-card__type{
    font-size:1.4rem
}
.flight-card__type{
    margin-top:1rem
}
.flight-card__action{
    text-align:center
}
.flight-card__time{
    display:inline-block;
    margin-bottom:.8rem;
    font-size:1rem;
    font-weight:var(--font-weight-medium)
}
.flight-card__city{
    margin-bottom:.4rem;
    font-size:1.3rem
}
.flight-card__day{
    font-size:1rem
}

</style>

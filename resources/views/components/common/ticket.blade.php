
@props(['packageAirlines'])
<div>
    <div class="row">
        <div class="flights">
            <section class="flights-list">
               
                @foreach($packageAirline as $airline)
                    {{$airline}}
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
                            <time class="flight-card__time">10:30 AM</time>
                            <h2 class="flight-card__city">{{ $airline['airline_name'] }}</h2>
                            <time class="flight-card__day">Tuesday, Apr 21, 2020</time>
                        </div>
                        <!-- /.flight-card__departure -->
                        <div class="flight-card__route">
                            <p class="flight-card__duration">1hr 50m</p>
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
                            <time class="flight-card__time">10:30 AM</time>
                            <h2 class="flight-card__city">Rome</h2>
                            <time class="flight-card__day">Tuesday, Apr 21, 2020</time>
                        </div>
                        <!-- /.flight-card__arrival -->
                        <div class="flight-card__action">
                            <img src="{{ URL::asset('/assets/images/airlines/EK.png') }}" alt="" height="50"
                                    class="logo">
                        </div>
                        <!-- /.flight-card__action -->
                    </article>
                @endforeach
                <!-- /.flight-card -->
            </section>

        </div>
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
    img {
        display: block;
        max-width: 100%;
    }

    .container {
        margin: 4rem auto;
        width: 100%;
        padding: 0 4rem;
    }

    .dashboard {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        grid-template-rows: auto auto;
        grid-gap: 3rem;
    }

    .dashboard .booking-bar,
    .dashboard .flights {
        grid-column: 1/10;
    }

    .dashboard .user-card,
    .dashboard .sidebar {
        grid-column: 10/-1;
    }

    .dashboard .sidebar {
        align-self: start;
    }

    .dashboard .user-card {
        grid-row: 1/1;
    }

    .icon-input {
        position: relative;
    }

    .icon-input__icon {
        position: absolute;
        left: 0.5em;
        top: 50%;
        color: HSL(var(--color-purple));
        transform: translateY(-50%);
    }

    .icon-input input {
        padding-left: 3em;
    }

    .checkbox {
        position: absolute;
        left: -9999px;
        opacity: 0;
    }

    .checkbox+label {
        position: relative;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .checkbox+label::before {
        border-radius: 0.8rem;
        content: '';
        display: inline-block;
        margin-right: 1rem;
        background-color: HSL(var(--color-light-purple));
        width: 2.5rem;
        height: 2.5rem;
        vertical-align: text-top;
        transition: 0.5s background-color var(--ease-out-quart);
    }

    .checkbox+label::after {
        display: inline-block;
        position: absolute;
        left: 0.6rem;
        top: 0.7rem;
        font-size: 1.2rem;
        font-family: 'Font Awesome 5 Pro';
        font-weight: 600;
        color: #fff;
        content: "\f00c";
        visibility: hidden;
    }

    .checkbox:hover+label::before {
        background-color: HSL(var(--color-purple));
    }

    .checkbox:checked+label::before {
        background-color: HSL(var(--color-purple));
    }

    .checkbox:checked+label::after {
        visibility: visible;
    }

    .button {
        border-radius: 0.8rem;
        padding: 0.75em 2em;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: HSL(var(--button-background-color, var(--color-orange)));
        color: HSL(var(--button-text-color, 0, 0%, 100%));
        font-size: 18px;
        border: none;
        cursor: pointer;
        transition: background-color 0.7s var(--ease-out-quart), color 0.7s var(--ease-out-quart);
    }

    .button:hover {
        background-color: HSL(var(--button-hover-background-color, var(--color-dark-orange)));
        color: HSL(var(--button-hover-text-color, 0, 0%, 100%));
    }

    .button--purple {
        --button-background-color: var(--color-light-purple);
        --button-text-color: var(--color-purple);
        --button-hover-background-color: var(--color-purple);
    }

    .choice-list__item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .choice-list__item:not(:last-child) {
        margin-bottom: 1rem;
    }

    .choice-list__aside {
        font-size: 14.5px;
    }

    .styled-price {
        font-size: 4rem;
        font-weight: var(--font-weight-medium);
    }

    .styled-price sup {
        vertical-align: top;
        font-size: 1.5rem;
        font-weight: var(--font-weight-normal);
    }

    .styled-price sub {
        vertical-align: bottom;
        font-size: 1.2rem;
        font-weight: var(--font-weight-normal);
    }

    .route-line {
        position: relative;
        margin: 1rem 0 0;
        width: 100%;
        height: 1px;
        border: 0.1rem dashed #f46a6a;
    }

    .route-line__stop {
        border-radius: 100%;
        box-sizing: content-box;
        width: 0.8rem;
        height: 0.8rem;
        position: absolute;
        top: 50%;
        background-color:#f46a6a;
        transform: translate3d(-50%, -50%, 0);
    }

    .route-line__stop-name {
        margin-top: 1.5rem;
        font-size: 14.5px;
        transform: translateX(-0.7rem);
    }

    .route-line__start {
        left: 0;
        border: 0.2rem solid #f46a6a;
        background-color: #fff;
    }

    .route-line__end {
        right: 0;
        border: 0.2rem solid #f46a6a;
        transform: translate3d(50%, -50%, 0);
    }

    .booking-bar {
        border-radius: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 3rem;
        background-color: HSL(var(--color-purple));
        color: #fff;
    }

    .booking-bar__inputs {
        display: flex;
        align-items: center;
    }

    .booking-bar__inputs .icon-input:not(:last-of-type) {
        margin-right: 2rem;
    }

    .booking-bar__heading {
        margin-bottom: 0.8rem;
        font-size: 18px;
        font-weight: var(--font-weight-medium);
        letter-spacing: 0.05rem;
    }

    .booking-bar__sub-heading {
        font-size: 14.5px;
        letter-spacing: 0.05rem;
    }

    .user-card {
        border-radius: 1.5rem;
        box-shadow: 0 0 0.1rem HSLA(var(--color-purple), 0.1);
        display: flex;
        align-items: center;
        padding: 2rem;
        background-color: #fff;
    }

    .user-card__avatar {
        border-radius: 100%;
        overflow: hidden;
        margin-right: 2rem;
    }

    .user-card__heading {
        line-height: 1.25;
        font-size: 1.5rem;
    }

    .user-card__name {
        display: block;
        font-weight: 600;
    }

    .flights__total {
        margin-bottom: 1rem;
        font-weight: var(--font-weight-medium);
    }

    .flights__total span {
        font-size: 1.3rem;
    }

    .top-flights {
        display: flex;
        justify-content: space-between;
        margin-bottom: 3rem;
    }

    .top-flights .top-flight-card:not(:last-child) {
        margin-right: 2rem;
    }

    .top-flight-card {
        border-radius: 1.5rem;
        box-shadow: 0 0 0.1rem HSLA(var(--color-purple), 0.1);
        display: flex;
        padding: 2rem;
        background-color: HSLA(var(--color-off-white));
        cursor: pointer;
        transition: 0.6s var(--ease-out-quart);
    }

    .top-flight-card__price {
        margin-right: 1.5rem;
    }

    .top-flight-card__heading {
        margin-bottom: 0.4rem;
        font-weight: var(--font-weight-medium);
    }

    .top-flight-card__sub-heading {
        font-size: 1rem;
    }

    .top-flight-card.is-active,
    .top-flight-card:hover {
        background-color: HSL(var(--color-purple));
        color: #fff;
    }

    .flights-list__item:not(:last-child) {
        margin-bottom: 2.5rem;
    }

    .flight-card {
        border-radius: 1.5rem;
        box-shadow: 0 0 0.1rem HSLA(var(--color-purple), 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: HSLA(var(--color-off-white));
        padding:2rem;
    }

    .flight-card__airline {
        border-radius: 100%;
        overflow: hidden;
        flex: 0 1 5rem;
        border: 0.2rem solid #fff;
    }

    .flight-card__airline+.flight-card__airline {
        position: relative;
        top: -1.5rem;
    }

    .flight-card__departure {
        margin-left: 2rem;
    }

    .flight-card__arrival {
        margin-right: 3rem;
        text-align: right;
    }

    .flight-card__route {
        display: flex;
        flex-direction: column;
        flex: 1 0 auto;
        justify-content: center;
        align-items: center;
        padding: 0 10px;
    }

    .flight-card__duration,
    .flight-card__type {
        font-size: 14.5px;
    }

    .flight-card__type {
        margin-top: 1rem;
    }

    .flight-card__action {
        text-align: center;
    }

    .flight-card__time {
        display: inline-block;
        margin-bottom: 0.8rem;
        font-size: 20px;;
        font-weight: var(--font-weight-medium);
    }

    .flight-card__city {
        margin-bottom: 0.4rem;
        font-size: 18px;
    }

    .flight-card__day {
        font-size: 14.5px;
    }

    .flight-card__price {
        margin-bottom: 1rem;
    }

    .flight-card__cta {
        min-width: 16rem;
    }

    .sidebar {
        box-shadow: 0 0 0.1rem #f46a6a, 0.1;
        border-radius: 1.5rem;
        margin-top: 2.6rem;
        padding: 3rem 2rem;
        background-color: #fff;
    }

    .sidebar__action {
        width: 100%;
    }

    .sidebar-section:not(:last-child) {
        margin-bottom: 4rem;
    }

    .sidebar-section__heading {
        margin-bottom: 1.5rem;
        font-size: 2.2rem;
        font-weight: var(--font-weight-medium);
    }
</style>

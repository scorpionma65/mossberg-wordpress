function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
		'total': t,
		'days': days,
		'hours': hours,
		'minutes': minutes,
		'seconds': seconds
    };
}

function initializeClock(id, endtime) {
	var clock = document.getElementById('clockdiv'+id);
	var daysSpan = clock.querySelector('.days');
	var hoursSpan = clock.querySelector('.hours');
	var minutesSpan = clock.querySelector('.minutes');
	var secondsSpan = clock.querySelector('.seconds');
	
	function updateClock() {
		var t = getTimeRemaining(endtime);
		
		daysSpan.innerHTML = t.days;
		hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
		minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
		secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
		
		if (t.total <= 0) {
			clearInterval(timeinterval);
			var timer = document.getElementById('timer'+id);
			var timervals = document.getElementById('timervals'+id).value.split('|||');
			var timer_class = timervals[0];
			var timer_style = timervals[1];
			var timer_link = timervals[2];
			if(timer.className == 'promo_countdown_block') {
				timer.className = timer_class;
				timer.style.backgroundImage = "url("+timer_style+")";
				timer.setAttribute('href', timer_link);
			}
		}
	}	
	updateClock();
	var timeinterval = setInterval(updateClock, 1000);
}

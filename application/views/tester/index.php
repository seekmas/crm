<div class="progress progress-striped">
    <div id="demo" class="bar" style="width:0%;"></div>
</div>

<script>
$(function() {
	setInterval( run , 100);
	setInterval( timeshow , 1000);
});

var n = 0;
var d = 1;


var run = function () {
	$bar = $('#demo');

	$bar.attr({ style : 'width:'+n+'%' });
	if( n > 105)
		d=0;
	else if( n < -5 )
		d=1;

	if( d === 0 )
		n--;
	else if( d === 1)
		n++;
	$('#info').text( n);
}


</script>
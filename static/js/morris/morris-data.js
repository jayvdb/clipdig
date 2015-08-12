$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '2010 Q2',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }, {
            period: '2010 Q3',
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
        }, {
            period: '2010 Q4',
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
        }, {
            period: '2011 Q1',
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
        }, {
            period: '2011 Q2',
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
        }, {
            period: '2011 Q3',
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
        }, {
            period: '2011 Q4',
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
        }, {
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    //});

    //Morris.Bar({
        //element: 'morris-bar-chart',
        //data: [{y: '2006',a: 100,b: 90}, 
					//{y: '2007',a: 75,b: 65}, 
					//{y: '2008',a: 50,b: 40},
					//{y: '2009',a: 75,b: 65},
					//{y: '2010',a: 50,b: 40},
					//{y: '2011',a: 75,b: 65}, 
					//{y: '2012',a: 100,b: 90}
					//],
        //xkey: 'y',
        //ykeys: ['a', 'b'],
        //labels: ['Series A', 'Series B'],
        //hideHover: 'auto',
        //resize: true
    //});
    Morris.Bar({
			element: 'morris-bar-chart',
			data: [
				{y: '2015',de:869,ko:3549,re:129,te:177,vi:1597,ok:188,li:107},
				{y: '2014',de:0,ko:4818,re:528,te:31,vi:1780,ok:474,li:0},
				{y: '2013',de:0,ko:694,re:524,te:0,vi:5485,ok:279,li:0},
				{y: '2012',de:0,ko:0,re:701,te:0,vi:33,ok:0,li:0},
				{y: '2011',de:0,ko:0,re:221,te:0,vi:0,ok:0,li:0},
				{y: '2010',de:0,ko:0,re:368,te:0,vi:0,ok:0,li:0},
				{y: '2009',de:0,ko:0,re:0,te:0,vi:513,ok:0,li:0}
			],
			xkey: 'y',
			ykeys: ['de','ko','re','te','vi','ok','li'],
			labels: ['DETIK','KOMPAS','REPUBLIKA','TEMPO','VIVA','OKEZONE','LIPUTAN6'],
			hideHover: 'auto',
			resize: true
		});
    

});

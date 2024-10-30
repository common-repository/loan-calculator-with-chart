jQuery(document).ready(function(event) {

var P, R, N, pie, line;

// update loan amount
var loan_amt_slider = document.getElementById("loan-amount");
var loan_amt_thumb_position = (loan_amt_slider.value - loan_amt_slider.min) * 100 / (loan_amt_slider.max - loan_amt_slider.min);
loan_amt_slider.style.backgroundSize = loan_amt_thumb_position + '% 100%';
loan_amt_slider.addEventListener("input", (self) => {
	let target = self.target;
    const min = target.min;
    const max = target.max;
    const val = target.value;

	document.querySelector("#loan-amt-text").innerText = parseInt(self.target.value).toLocaleString("en-US") + "$";
	target.style.backgroundSize = (val - min) * 100 / (max - min) + '% 100%';
	P = parseFloat(self.target.value);
	displayDetails();
});


// update Rate of Interest
var int_rate_slider = document.getElementById("interest-rate");
var rate_thumb_position = (int_rate_slider.value - int_rate_slider.min) * 100 / (int_rate_slider.max - int_rate_slider.min);
int_rate_slider.style.backgroundSize = rate_thumb_position + '% 100%';
int_rate_slider.addEventListener("input", (self) => {
	let target = self.target;
    const min = target.min
    const max = target.max
    const val = target.value
	document.querySelector("#interest-rate-text").innerText =
		self.target.value + "%";
	self.target.style.backgroundSize = (val - min) * 100 / (max - min) + '% 100%';
	R = parseFloat(self.target.value);
	displayDetails();
});

// update loan period
var loan_period_slider = document.getElementById("loan-period");
var period_thumb_position = (loan_period_slider.value - loan_period_slider.min) * 100 / (loan_period_slider.max - loan_period_slider.min);
loan_period_slider.style.backgroundSize = period_thumb_position + '% 100%';
loan_period_slider.addEventListener("input", (self) => {
	let target = self.target;
    const min = target.min
    const max = target.max
    const val = target.value
	document.querySelector("#loan-period-text").innerText =
		self.target.value + " years";
	self.target.style.backgroundSize = (val - min) * 100 / (max - min) + '% 100%';
	N = parseFloat(self.target.value);
	displayDetails();
});


// calculate total Interest payable
function calculateLoanDetails(p, r, emi) {
	/*
		p: principal
		r: rate of interest
		emi: monthly emi
	*/
	let totalInterest = 0;
	let yearlyInterest = [];
	let yearPrincipal = [];
	let years = [];
	let year = 1;
	let [counter, principal, interes] = [0, 0, 0];
	while (p > 0) {
		let interest = parseFloat(p) * parseFloat(r);
		p = parseFloat(p) - (parseFloat(emi) - interest);
		totalInterest += interest;
		principal += parseFloat(emi) - interest;
		interes += interest;
		if (++counter == 12) {
			years.push(year++);
			yearlyInterest.push(parseInt(interes));
			yearPrincipal.push(parseInt(principal));
			counter = 0;
		}
	}
	if(loan_calc_style.laon_enable_yearly_breakdown_chart == 'true'){
		line.data.datasets[0].data = yearPrincipal;
		line.data.datasets[1].data = yearlyInterest;
		line.data.labels = years;
	}
	return totalInterest;
}

// calculate details
function displayDetails() {
	let r = parseFloat(R) / 1200;
	let n = parseFloat(N) * 12;

	let num = parseFloat(P) * r * Math.pow(1 + r, n);
	let denom = Math.pow(1 + r, n) - 1;
	let emi = parseFloat(num) / parseFloat(denom);

	let payabaleInterest = calculateLoanDetails(P, r, emi).toFixed(0);

	let opts = '{style: "decimal", currency: "US"}';

	document.querySelector("#loan_calc_cp").innerText =
		parseFloat(P).toLocaleString("en-US", opts) + "$";

	document.querySelector("#loan_calc_ci").innerText =
		parseFloat(payabaleInterest).toLocaleString("en-US", opts) + "$";

	document.querySelector("#loan_calc_ct").innerText =
		parseFloat(parseFloat(P) + parseFloat(payabaleInterest)).toLocaleString(
			"en-US",
			opts
		) + "$";

	document.querySelector("#loan-calc-price").innerText =
		parseInt(emi).toLocaleString("en-US", opts) + "$";

	if(loan_calc_style.laon_enable_breakup_chart == 'true'){
		pie.data.datasets[0].data[0] = P;
		pie.data.datasets[0].data[1] = payabaleInterest;
		pie.update();
	}
	if(loan_calc_style.laon_enable_yearly_breakdown_chart == 'true'){
		line.update();
	}
}

// Initialize everything
function initialize() {

	document.querySelector("#loan-amt-text").innerText =
		parseInt(loan_amt_slider.value).toLocaleString("en-US") + "$";
	P = parseFloat(document.getElementById("loan-amount").value);

	document.querySelector("#interest-rate-text").innerText =
		int_rate_slider.value + "%";
	R = parseFloat(document.getElementById("interest-rate").value);

	document.querySelector("#loan-period-text").innerText =
		loan_period_slider.value + " years";
	N = parseFloat(document.getElementById("loan-period").value);

	if(loan_calc_style.laon_enable_breakup_chart == 'true'){
		if(loan_calc_style.laon_payment_breakup_chart_type == 'doughnut_chart'){
			pie = new Chart(document.getElementById("loan_calc_pieChart"), {
				type: "doughnut",
				data: {
					labels: [loan_calc_style.laon_chart_principal_amou_text, loan_calc_style.laon_chart_total_interest_text],
					datasets: [
						{
							label: "Home Loan Details",
							data: [P, 0],
							backgroundColor: [loan_calc_style.laon_chart_principal_loan_color, loan_calc_style.laon_chart_total_interest_color],
							hoverOffset: 4
						}
					]
				},
				options: {
					plugins: {
						title: {
							display: true,
							text: loan_calc_style.laon_chart_breakup_text
						}
					},
					// responsive: true,
		            // maintainAspectRatio: false,
				}
			});
		}else if(loan_calc_style.laon_payment_breakup_chart_type == 'pie_chart'){

	        var loandata = {
	            labels: [loan_calc_style.laon_chart_principal_amou_text, loan_calc_style.laon_chart_total_interest_text],
	            datasets: [
	                {
	                    data: [P, 0],
	                    backgroundColor: [
	                    	loan_calc_style.laon_chart_principal_loan_color, 
	                    	loan_calc_style.laon_chart_total_interest_color
	                	],
	                    hoverOffset: 4
	                }]
	        };
	        pie = new Chart(document.getElementById("loan_calc_pieChart"), {
	          type: 'pie',
	          data: loandata,
	          options: {
					plugins: {
						title: {
							display: true,
							text: loan_calc_style.laon_chart_breakup_text
						}
					},
					// responsive: true,
		            // maintainAspectRatio: false,
				}
	        });
	    }else if(loan_calc_style.laon_payment_breakup_chart_type == 'bar_chart'){
	    	pie = new Chart(document.getElementById("loan_calc_pieChart"), {
			  	type: "bar",
			  	data: {
			    labels: [
				    	loan_calc_style.laon_chart_principal_amou_text,
				    	loan_calc_style.laon_chart_total_interest_text,
			    	],
			    	datasets: [{
			      		backgroundColor: [
					    	loan_calc_style.laon_chart_principal_loan_color, 
					    	loan_calc_style.laon_chart_total_interest_color
				    	],
			      		data: [P, 0],
			    	}]
			  	},
			  	options: {
			  		
					plugins: {
						legend: {display: false},
						title: {
							display: true,
							text: loan_calc_style.laon_chart_breakup_text
						}
					},
				}
			});
	    }else if(loan_calc_style.laon_payment_breakup_chart_type == 'polar_area_chart'){
	        var polar_Data = {
	          	labels: [
	          		loan_calc_style.laon_chart_principal_amou_text,
	          		loan_calc_style.laon_chart_total_interest_text
          		],
	          	datasets: [{
		            data: [P, 0],
		            backgroundColor: [
			            loan_calc_style.laon_chart_principal_loan_color, 
						loan_calc_style.laon_chart_total_interest_color
		            ]
	          	}]
	        };

	        pie = new Chart(document.getElementById("loan_calc_pieChart"), {
	          	type: 'polarArea',
	          	data: polar_Data,
	          	options: {
					plugins: {
						title: {
							display: true,
							text: loan_calc_style.laon_chart_breakup_text
						}
					},
				}
	        });
	    }
        
	}

	if(loan_calc_style.laon_enable_yearly_breakdown_chart == 'true'){
		line = new Chart(document.getElementById("loan_calc_lineChart"), {
			data: {
				datasets: [
					{
						type: "line",
						label: loan_calc_style.laon_chart_year_princ_paid_text,
						borderColor: loan_calc_style.laon_chart_yearly_principal_paid_color,
						data: []
					},
					{
						type: "line",
						label: loan_calc_style.laon_chart_year_interest_paid_text,
						borderColor: loan_calc_style.laon_chart_yearly_interest_paid_color,
						data: []
					}
				],
				labels: []
			},
			options: {
				plugins: {
					title: {
						display: true,
						text: loan_calc_style.laon_chart_year_breakdown_text
					}
				},
				scales: {
					x: {
						title: {
							color: "grey",
							display: true,
							text: "Years Passed"
						}
					},
					y: {
						title: {
							color: "grey",
							display: true,
							text: "Money in Rs."
						}
					}
				}
			}
		});
	}
	displayDetails();
}
initialize();
});
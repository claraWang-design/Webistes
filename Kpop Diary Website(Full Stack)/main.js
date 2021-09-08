function ajax(endpoint,returnFunction) {

	let httpRequest = new XMLHttpRequest();

	httpRequest.open("GET", endpoint);
	httpRequest.send();

	httpRequest.onreadystatechange = function() {
		//console.log(httpRequest.readyState);

		
		if( httpRequest.readyState == 4) {

			if(httpRequest.status == 200) {
				returnFunction(httpRequest.responseText);
			}
			else {
				console.log(httpRequest.status);
			}

		}

	}
}


function displayResults(results) {

	//console.log(results);

	let convertedResults = JSON.parse(results);
	console.log(convertedResults);
	console.log(convertedResults._embedded.events[0]);

	let row = document.querySelector(".displayrow");

	while( row.hasChildNodes() ) {
		row.removeChild( row.lastChild )
	}

	if( convertedResults.page.size == 0){
		let page = document.querySelector(".displayrow");
		let none1 = document.createElement("h4");
		let none2 = document.createElement("h4");
		none1.innerHTML = "Sorry it seems like we cannot find the movie you are looking for... (*T_T*)";
		none2.innerHTML = "Maybe try other movies you like ψ(｀∇´)ψ";
		page.appendChild(none1);
		page.appendChild(none2);
	}

	for(let i = 0; i <20; i++) {

		let row = document.querySelector(".displayrow");
		let col_div = document.createElement("div");
		let image = document.createElement("img");
		let name = document.createElement("h6");
		let date = document.createElement("p");
		let url = document.createElement("a");
		let brTag = document.createElement("br");

		url.innerHTML = convertedResults._embedded.events[i].name;
		//date.innerHTML = convertedResults._embedded.events[i].dates.initialStartDate.localDate;
		image.src = convertedResults._embedded.events[i].images[0].url;
		url.href = convertedResults._embedded.events[i].url;
		url.target = "_blank";

		image.classList.add("shadow", "img-fluid");
		col_div.classList.add("col-lg-3", "col-md-4", "items");

		col_div.appendChild(image);
		col_div.appendChild(brTag);
		col_div.appendChild(url);
		col_div.appendChild(date);

		row.appendChild(col_div);

	}

}

let endpoint = "https://app.ticketmaster.com/discovery/v2/events.json?keyword=&apikey=s2fduXkqihRXXWxQiQA5NeJZhH1YV5V0";
		
ajax(endpoint, displayResults);

document.querySelector("#search-form").onsubmit = function(event) {

	event.preventDefault();

	let searchInput = document.querySelector("#search-id").value.trim();
	
	let endpoint = "https://app.ticketmaster.com/discovery/v2/events.json?keyword=" + searchInput +
	"&apikey=s2fduXkqihRXXWxQiQA5NeJZhH1YV5V0";
		
	ajax(endpoint, displayResults);

}
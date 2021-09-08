function ajax(endpoint,returnFunction) {

	let httpRequest = new XMLHttpRequest();

	httpRequest.open("GET", endpoint);
	httpRequest.send();

	httpRequest.onreadystatechange = function() {
		console.log(httpRequest.readyState);

		
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

	let show = document.querySelector("#show");

	while( show.hasChildNodes() ) {
		show.removeChild( show.lastChild )
	}

	let row = document.querySelector(".row");

	while( row.hasChildNodes() ) {
		row.removeChild( row.lastChild )
	}

	let convertedResults = JSON.parse(results);

	console.log(convertedResults);

	let text = document.createElement("p");
	let line = document.querySelector("#show");
	text.innerHTML = "Showing " + convertedResults.results.length + " of " 
		+ convertedResults.total_results + " result(s)";
	line.appendChild(text);

	if( convertedResults.total_results == 0){
		let page = document.querySelector("#page");
		let none1 = document.createElement("h4");
		let none2 = document.createElement("h4");
		none1.innerHTML = "Sorry it seems like we cannot find the movie you are looking for... (*T_T*)";
		none2.innerHTML = "Maybe try other movies you like ψ(｀∇´)ψ";
		page.appendChild(none1);
		page.appendChild(none2);
	}

	for(let i = 0; i <20; i++) {

		let row = document.querySelector(".row");
		let img_div = document.createElement("div");
		let col = document.createElement("div");
		let name = document.createElement("h6");
		let date = document.createElement("p");
		let image = document.createElement("img");

		if (convertedResults.results[i].poster_path == null ){
			image.src = "images/no.jpg"
		}
		else{
			image.src = "https://image.tmdb.org/t/p/w500/" + 
			convertedResults.results[i].poster_path;
		}

		name.innerHTML = convertedResults.results[i].title;
		date.innerHTML = convertedResults.results[i].release_date;

		name.classList.add("caption");
		date.classList.add("caption");

		col.classList.add("col-lg-3", "col-md-4", "col-sm-6", "col-6", "movie");

		let rating = document.createElement("h5");
		let vote = document.createElement("p");
		let info = document.createElement("p");
		let top = document.createElement("div");


		rating.innerHTML = "Rating: " + convertedResults.results[i].vote_average;
		vote.innerHTML = "Vote(s): " + convertedResults.results[i].vote_count;
		info.classList.add("overview");

		let synop = convertedResults.results[i].overview;

		if ( synop.length > 200){
			for(let i = 0; i <= 200; i++){
				info.innerHTML += synop[i];
			}
			info.innerHTML += "...";
		}
		else {
			info.innerHTML = synop;
		}
		top.appendChild(rating);
		top.appendChild(vote);
		top.appendChild(info);

		img_div.appendChild(image);
		img_div.appendChild(top);
		img_div.classList.add("image");

		col.appendChild(img_div);
		col.appendChild(name);
		col.appendChild(date);

		top.classList.add("top");

		row.appendChild(col);


	}


}

let endpoint = "https://api.themoviedb.org/3/movie/now_playing?api_key=f0964c58bfb8693cab9b4f6e6f5395a8&language=en-US&page=1";

	ajax(endpoint, displayResults);


document.querySelector("#search-form").onsubmit = function(event) {

	event.preventDefault();

	let searchInput = document.querySelector("#search-id").value.trim();
	
	let endpoint = "https://api.themoviedb.org/3/search/movie?api_key=f0964c58bfb8693cab9b4f6e6f5395a8&language=en-US&query="
		+ searchInput + "&page=1&include_adult=false";
		
	ajax(endpoint, displayResults);

}
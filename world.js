window.onload = function(){
    var lookup = document.getElementById("lookup");
    var lookupcity = document.getElementById("lookupcities");
    console.log(lookupcity);
    // console.log(lookup);
    var resultArea = document.getElementById("result");
    console.log(resultArea);
    var country = document.querySelector("input");
    console.log(country);
    lookup.addEventListener('click', handleClick);
    lookupcity.addEventListener('click', handleClickCity);
    var httpRequest = new XMLHttpRequest();

    function handleClick(clickEvent){
        clickEvent.preventDefault();
        console.log("I GOT CLICKED")
        var url = "world.php?country=" + country.value;
        console.log(country.value);
        httpRequest.onreadystatechange = fetchingdata;
        httpRequest.open('GET', url, true);
        httpRequest.send();
    }
    
    function handleClickCity(clickEvent){
        clickEvent.preventDefault();
        console.log("I GOT CLICKED")
        var url = "world.php?country=" + country.value + "&context=cities";
        console.log(country.value);
        httpRequest.onreadystatechange = fetchingCityData;
        httpRequest.open('GET', url, true);
        httpRequest.send();
    }
    function fetchingdata(){
        if (httpRequest.readyState === XMLHttpRequest.DONE){
            if (httpRequest.status === 200){
                var response = httpRequest.responseText;
                resultArea.innerHTML = response;
            }
            else{
                resultArea.innerHTML = "Error: This resquest can not be deliver. Please try again.";
            }
        }
    }

    function fetchingCityData(){
        if (httpRequest.readyState === XMLHttpRequest.DONE){
            if (httpRequest.status === 200){
                var response = httpRequest.responseText;
                resultArea.innerHTML = response;
            }
            else{
                resultArea.innerHTML = "Error: This resquest can not be deliver. Please try again.";
            }
        }
    }
}
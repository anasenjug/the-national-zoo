<?php
include "spoj.php"; 
include "nav.php";

?>
<body>
    <div>
        <div id="background-element">
            <h1>WELCOME</h1>
        </div>
       
    </div>
    <div class="home_content">
    <ul>
            <li><a href="news.php"><img src="images/news_events.svg" alt=""></a></li>
            <li><a href="explore.php"><img src="images/explore.svg" alt=""></a></li>
            <li><a href="contact_support.php"><img src="images/contact.svg" alt=""></a></li>
        </ul>
        <div class="animal_container">
        <h1>Animal Information</h1>
        <div class="search-container">
            <input type="text" id="animalNameInput" placeholder="Enter an animal name">
            <button onclick="searchAnimal()">Search</button>
        </div>
        <div id="animalInfo" class="animal-info"></div>
    </div>
    </div>
   
    <script>
    function searchAnimal() {
    var name = document.getElementById('animalNameInput').value.trim();
    if (name === '') {
        alert('Please enter an animal name.');
        return;
    }
    
    $.ajax({
        method: 'GET',
        url: 'https://api.api-ninjas.com/v1/animals?name=' + name,
        headers: { 'X-Api-Key': 'BazWvhI6K/za5XmbSaN85w==iEtZe2D11C6xiwfr'}, 
        contentType: 'application/json',
        success: function(result) {
            displayAnimalInfo(result);
        },
        error: function ajaxError(jqXHR) {
            console.error('Error: ', jqXHR.responseText);
            // Handle errors here
        }
    });
}

function displayAnimalInfo(animalData) {
    var animalInfoDiv = document.getElementById('animalInfo');
    animalInfoDiv.innerHTML = '';

    animalData.forEach(function(animal) {
        var animalSection = document.createElement('div');
        animalSection.classList.add('animal-section');

        var heading = document.createElement('h2');
        heading.textContent = animal.name;
        animalSection.appendChild(heading);

        var taxonomyList = document.createElement('ul');
        taxonomyList.innerHTML = '<b>Taxonomy:</b>';
        for (var key in animal.taxonomy) {
            var listItem = document.createElement('li');
            listItem.textContent = `${key}: ${animal.taxonomy[key]}`;
            taxonomyList.appendChild(listItem);
        }
        animalSection.appendChild(taxonomyList);

        var characteristicsList = document.createElement('ul');
        characteristicsList.innerHTML = '<b>Characteristics:</b>';
        for (var key in animal.characteristics) {
            var listItem = document.createElement('li');
            listItem.textContent = `${key.replace(/_/g, ' ')}: ${animal.characteristics[key]}`;
            characteristicsList.appendChild(listItem);
        }
        animalSection.appendChild(characteristicsList);

        var locations = document.createElement('p');
        locations.innerHTML = `<b>Locations:</b> ${animal.locations.join(', ')}`;
        animalSection.appendChild(locations);

        animalInfoDiv.appendChild(animalSection);
    });
}
</script>
    <?php 

    include "footer.php";
    ?>
</body>
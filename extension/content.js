let apiUrl = 'https://the200.herokuapp.com/api/v1/player/{{gamerTag}}/stats';

function updateProfiles($document) {
    let $listProfiles = $document.find('ul.game-detail-user-profiles');

    $listProfiles.find('li.profile-container').each(function (e) {
        let $profile = $(this);
        let $the200Container = $profile.find('div.the200container');
        if (!$the200Container.length) {
            // create and append the container for the200 stuff
            $the200Container = $('<div class="dark-transparent-bg well the200container"></div>');
            $profile.append($the200Container);
        }

        let $gamerTagContainer = $profile.find('h4.gamertag');
        let gamerTag = $gamerTagContainer.find('a').html();

        if (!gamerTag) {
            console.error('Gamer tag "' + gamerTag + '" not found!');
            return;
        }

        // Add the loading spinner and append to the profile
        $the200Container.html('<img src="http://samherbert.net/svg-loaders/svg-loaders/rings.svg" width="60"> Loading...');

        let url = apiUrl.replace('{{gamerTag}}', gamerTag);
        $.ajax({
            dataType: "json",
            url: url,
            success: function (data) {
                // Empty the container
                $the200Container.html('');

                // Append each stats to the container
                for (var i in data) {
                    $the200Container.append(i + ': ' + data[i] + '<br>');
                }
            }
        });
    })
}

// Listen for messages
chrome.runtime.onMessage.addListener(function (msg, sender, sendResponse) {
    // If the received message has the expected format...
    if (msg.text === 'report_back') {
        let $document = $(document.all[0]);

        updateProfiles($document);
    }
});

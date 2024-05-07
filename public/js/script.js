document.addEventListener('DOMContentLoaded', function() {
    const serverSpeeds = [
        { speed: '×10', key: 'x10' },
        { speed: '×1.000', key: 'x1000' },
        { speed: '×10.000', key: 'x10000' },
        { speed: '×50.000', key: 'x50000' },
        { speed: '×1.000.000', key: 'x1000000' },
        { speed: '×5.000.000', key: 'x5000000' },
        { speed: '×10.000.000', key: 'x10000000' }
    ];
		window.onload = function() {
    console.log("Window loaded.");
    document.getElementById('current-year').textContent = new Date().getFullYear();
};
    const serverList = document.getElementById('server-list');

    // Create buttons for each server speed
    serverSpeeds.forEach(server => {
        const button = document.createElement('button');
        button.type = 'button';
        button.classList.add('server-button');
        button.title = server.speed;
        button.setAttribute('data-server-key', server.key);
        button.innerHTML = `<span class="speed-icon"><i class="fas fa-tachometer-alt"></i></span>${server.speed}`;

        const listItem = document.createElement('li');
        listItem.classList.add('server');
        listItem.appendChild(button);

        serverList.appendChild(listItem);
    });
	var couponCheckButton = document.querySelector('.server-button[title="Enter your email to check for any unredeemed coupons"]');
    var couponCheckModal = document.getElementById('coupon-check-modal');
    var closeCouponModal = document.getElementById('close-coupon-modal');

    // Open the coupon check modal
    couponCheckButton.addEventListener('click', function() {
        couponCheckModal.style.display = 'block';
    });

    // Close the coupon check modal
    closeCouponModal.addEventListener('click', function() {
        couponCheckModal.style.display = 'none';
    });

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == couponCheckModal) {
            couponCheckModal.style.display = 'none';
        }
    };

    var leftModal = document.getElementById('left-popup');
    var rightModal = document.getElementById('right-popup');
    var playNowBtn = document.getElementById('play-now-button');
    var rightBtn = document.getElementById('right-button');
    var spans = document.getElementsByClassName('close');
    var progressBar = document.getElementById('progress-bar');
    var progressText = document.getElementById('progress-text');
    var serverInfoModal = document.getElementById('server-info-popup');
    var serverButtons = document.querySelectorAll('.server-button');
    var serverTimeElement = document.getElementById('servertime');
    var freeGoldValue = document.getElementById('free-gold-value'); // Added this line
    var roundStartTime = document.getElementById('round-start-time'); // Added this line

    playNowBtn.onclick = function() {
        if (rightModal.style.display !== 'block') {
            leftModal.style.display = 'block';
            serverInfoModal.style.display = 'none'; // Hide the secondary popup
        }
    };

    rightBtn.onclick = function() {
        if (leftModal.style.display !== 'block') {
            rightModal.style.display = 'block';
            serverInfoModal.style.display = 'none'; // Hide the secondary popup
        }
    };

    Array.from(spans).forEach(function(span) {
        span.onclick = function() {
            this.parentElement.parentElement.style.display = 'none';
            event.stopPropagation(); // Prevent the modal close button click from propagating
        };
    });

    serverInfoModal.onclick = function(event) {
        if (event.target === serverInfoModal) {
            serverInfoModal.style.display = 'none';
            event.stopPropagation(); // Stop the event from propagating to the document body
        }
    };

    document.body.addEventListener('click', function(event) {
        // If the click is on the modal background, close all modals
        if (event.target.classList.contains('modal')) {
            // Close the primary modal only if the secondary modal is not displayed
            if (serverInfoModal.style.display !== 'block') {
                leftModal.style.display = 'none';
                rightModal.style.display = 'none';
            }
            // Close the secondary modal
            serverInfoModal.style.display = 'none';
        }
    });

    serverButtons.forEach(function(button) {
        button.onclick = function() {
            var serverKey = this.getAttribute('data-server-key');
            document.getElementById('server-info-title').textContent = this.getAttribute('title');
            serverInfoModal.style.display = 'block';
            resetAndAnimateProgress(0); // Reset progress when a server is selected
            fetchTotalRegisteredPlayers(serverKey);
            fetchOnlinePlayers(serverKey);
            fetchGameProgress(serverKey);
            updateActionButtons(serverKey);
            fetchDefaultGold(serverKey); // Fetch default gold value
            fetchRoundStartTime(serverKey); // Fetch round start time
        };
    });

    function updateActionButtons(serverKey) {
        console.log("Updating action buttons with serverKey:", serverKey); // Debugging

        // Ensure serverKey has a value
        if (!serverKey) {
            console.error('Server key is undefined or null. Please check the source of serverKey.');
            return; // Exit the function if serverKey is not valid
        }

        // Construct the URLs based on the server key
        var loginUrl = `https://${serverKey}.aspidanetwork.com/login.php`;
        var registerUrl = `https://${serverKey}.aspidanetwork.com/anmelden.php`;

        // Get the anchor elements
        var loginBtn = document.getElementById('login-button');
        var registerBtn = document.getElementById('register-button');

        if (!loginBtn || !registerBtn) {
            console.error('Login or Register button not found. Ensure IDs are correct.');
            return; // Exit if buttons are not found
        }

        // Set the href attribute of the anchor elements
        loginBtn.href = loginUrl;
        registerBtn.href = registerUrl;

        // Debugging: Log the URLs to confirm they are set correctly
        console.log("Login URL set to:", loginBtn.href);
        console.log("Register URL set to:", registerBtn.href);

        // Optionally, set target attribute to open in a new tab
        loginBtn.target = "_blank";
        registerBtn.target = "_blank";
    }

    function fetchDefaultGold(serverKey) {
        fetch(`/get_default_gold.php?serverKey=${encodeURIComponent(serverKey)}`)
            .then(response => response.json())
            .then(data => {
                if (data.defaultGold !== null) {
                    freeGoldValue.textContent = data.defaultGold;
                } else {
                    freeGoldValue.textContent = 'Not available';
                }
            })
            .catch(error => {
                console.error('Error fetching default gold:', error);
                freeGoldValue.textContent = 'Error fetching data';
            });
    }

    function fetchGameProgress(serverKey) {
        fetch(`/get_server_data.php?serverKey=${encodeURIComponent(serverKey)}`)
            .then(response => response.json())
            .then(data => {
                if (data.progress) {
                    resetAndAnimateProgress(data.progress);
                }
            })
            .catch(error => console.error('Error fetching game progress:', error));
    }

	function fetchRoundStartTime(serverKey) {
		fetch(`/get_server_data.php?serverKey=${encodeURIComponent(serverKey)}`)
			.then(response => response.json())
			.then(data => {
				if (data.startTime) {
                roundStartTime.textContent = data.startTime;
				} else {
                roundStartTime.textContent = 'Started: N/A';
				}
			})
        .catch(error => console.error('Error fetching round start time:', error));
}


    function fetchTotalRegisteredPlayers(serverKey) {
        fetch(`/get_total_players.php?serverKey=${encodeURIComponent(serverKey)}`)
            .then(response => response.json())
            .then(data => {
                console.log("Total players data:", data);
                document.getElementById('total-registered-value').textContent = data.totalPlayers;
            })
            .catch(error => {
                console.error('Error fetching total players:', error);
                document.getElementById('total-registered-value').textContent = 'Error fetching data';
            });
    }

    function fetchOnlinePlayers(serverKey) {
        fetch(`/get_online_players.php?serverKey=${encodeURIComponent(serverKey)}`)
            .then(response => response.json())
            .then(data => {
                console.log("Online players data:", data);
                document.getElementById('online-players-value').textContent = data.onlinePlayers;
            })
            .catch(error => {
                console.error('Error fetching online players:', error);
                document.getElementById('online-players-value').textContent = 'Error fetching data';
            });
    }

    function resetAndAnimateProgress(targetPercentage) {
        progressBar.style.width = '0%';
        progressText.textContent = '0%';

        if (window.progressAnimation) clearInterval(window.progressAnimation);

        let currentPercentage = 0;
        window.progressAnimation = setInterval(() => {
            if (currentPercentage <= targetPercentage) {
                progressBar.style.width = `${currentPercentage}%`;
                progressText.textContent = `${currentPercentage}%`;
                currentPercentage++;
            } else {
                clearInterval(window.progressAnimation);
            }
        }, 30);
    }

    if (serverTimeElement) {
        var timeParts = serverTimeElement.innerHTML.split(':');
        var hours = parseInt(timeParts[0], 10);
        var minutes = parseInt(timeParts[1], 10);
        var seconds = parseInt(timeParts[2], 10);

        function updateServerTime() {
            seconds++;
            if (seconds >= 60) {
                seconds = 0;
                minutes++;
                if (minutes >= 60) {
                    minutes = 0;
                    hours++;
                    if (hours >= 24) {
                        hours = 0;
                    }
                }
            }
            serverTimeElement.innerHTML = [hours, minutes, seconds].map(function(part) {
                return part < 10 ? '0' + part : part;
            }).join(':');
        }
        setInterval(updateServerTime, 1000);
    }
});


document.addEventListener('DOMContentLoaded', function() {
    var tooltips = document.querySelectorAll('[title]');

    tooltips.forEach(function(element) {
        element.addEventListener('mouseenter', function(event) {
            // Create a new tooltip element
            var tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = element.getAttribute('title');
            document.body.appendChild(tooltip);

            // Position the tooltip
            var rect = element.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.top = rect.top + window.scrollY - tooltip.offsetHeight - 10 + 'px'; // 10px above the element

            // Show the tooltip
            tooltip.style.display = 'block';

            // Remove the title attribute to prevent the default tooltip
            element.setAttribute('data-original-title', element.getAttribute('title'));
            element.removeAttribute('title');
        });

        element.addEventListener('mouseleave', function(event) {
            // Remove the custom tooltip
            var tooltip = document.querySelector('.custom-tooltip');
            if (tooltip) {
                tooltip.remove();
            }

            // Restore the title attribute
            element.setAttribute('title', element.getAttribute('data-original-title'));
            element.removeAttribute('data-original-title');
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('couponRedeemForm');
    var emailInput = document.getElementById('email-input');
    var messagesDiv = document.querySelector('.messages');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData();
            formData.append('email', emailInput.value);
            formData.append('coupon_reminder', '1');

            fetch('api.php', {
                method: 'POST',
                body: FormData,
            })
            .then(response => response.json())
            .then(data => {
                messagesDiv.innerHTML = ''; // Clear existing messages
                if(data.status) {
                    // Success messages
                    data.message.forEach(function(msg) {
                        messagesDiv.innerHTML += '<li>' + msg + '</li>';
                    });
                } else {
                    // Error messages
                    data.message.forEach(function(msg) {
                        messagesDiv.innerHTML += '<li> ' + msg + '</li>';
                    });
                }
                messagesDiv.style.display = 'block'; // Make the messages div visible
            })
            .catch(error => {
                console.error('Error:', error);
                messagesDiv.innerHTML = '<li>' + error.message + '</li>';
                messagesDiv.style.display = 'block';
            });
        });
    }
	
});
document.addEventListener('DOMContentLoaded', function() {
    // Select the button that opens the webmail modal
    var webmailButton = document.querySelector('.server-button[data-button="webmail"]');
    // Select the webmail modal itself
    var webmailModal = document.getElementById('webmail-services-modal');
    // Select the close button of the webmail modal
    var closeWebmailModal = document.querySelector('#webmail-services-modal .close');

    // Log to the console to verify that the elements are found
    console.log({ webmailButton, webmailModal, closeWebmailModal });

    // Function to open the webmail modal
    function openWebmailModal() {
        console.log('Trying to open webmail modal');
        webmailModal.style.display = 'block';
    }

    // Function to close the webmail modal
    function closeWebmailModalFunc() {
        console.log('Trying to close webmail modal');
        webmailModal.style.display = 'none';
    }

    // Add click event listener to the webmail button
    webmailButton.addEventListener('click', openWebmailModal);

    // Add click event listener to the close button of the webmail modal
    closeWebmailModal.addEventListener('click', closeWebmailModalFunc);

    // Add global click event listener to close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === webmailModal) {
            closeWebmailModalFunc();
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var newsButton = document.querySelector('.server-button[data-button="news"]');
    var newsModal = document.getElementById('news-modal');
    var closeNewsModal = document.getElementById('close-news-modal');

    // Open the news modal
    newsButton.addEventListener('click', function() {
        newsModal.style.display = 'block';
        loadNews(); // Call a function to load news items
    });

    // Close the news modal
    closeNewsModal.addEventListener('click', function() {
        newsModal.style.display = 'none';
    });

    // Function to load news items into the modal
    function loadNews() {
        // Example: Load news via AJAX or API call
        // Here you would make an API call to your backend to fetch news items
        // For now, let's just add dummy content

        var newsContainer = document.querySelector('.news-container');
        newsContainer.innerHTML = ''; // Clear out any existing news

        // Dummy news data
        var newsData = [
			
            { title: 'New Server Launched', content: 'Our new server x50000 is now live! Join the battle.' },
            { title: 'Update Notes', content: 'Check out the latest update notes for new features and bug fixes.' },
            // ... more news items
        ];

        // Create news item elements and append to container
        newsData.forEach(function(news) {
            var newsItem = document.createElement('div');
            newsItem.classList.add('news-item');
            newsItem.innerHTML = `<h3>${news.title}</h3><p>${news.content}</p>`;
            newsContainer.appendChild(newsItem);
        });
    }
	// Close modals when clicking outside of them
    window.addEventListener('click', function(event) {
        if (event.target == newsModal) {
            newsModal.style.display = 'none';
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var rulesButton = document.querySelector(".server-button[data-button='rules']");
    var rulesModal = document.getElementById('rules-modal');
    var closeRulesModal = document.getElementById('close-rules-modal');

    // Open the rules modal
    rulesButton.addEventListener('click', function() {
        rulesModal.style.display = 'block';
        loadRules(); // Call a function to load rules items
    });

    // Close the rules modal
    closeRulesModal.addEventListener('click', function() {
        rulesModal.style.display = 'none';
    });

    // Function to load rules items into the modal
    function loadRules() {
        // Example: Load rules via AJAX or API call
        // Here you would make an API call to your backend to fetch rules items
        // For now, let's just add dummy content

        var rulesContainer = document.querySelector('.rules-container');
        rulesContainer.innerHTML = ''; // Clear out any existing rules

        // Dummy rules data
        var rulesData = [
            { title: 'Rule 1', content: 'No cheating or use of unauthorized third-party software.' },
            { title: 'Rule 2', content: 'Respect all players and staff members.' },
            // ... more rules items
        ];

        // Create rules item elements and append to container
        rulesData.forEach(function(rule) {
            var rulesItem = document.createElement('div');
            rulesItem.classList.add('rules-item');
            rulesItem.innerHTML = `<h3>${rule.title}</h3><p>${rule.content}</p>`;
            rulesContainer.appendChild(rulesItem);
        });
    }

    // Close modals when clicking outside of them
    window.addEventListener('click', function(event) {
        if (event.target == rulesModal) {
            rulesModal.style.display = 'none';
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var networkButton = document.querySelector('.server-button[data-button="our-network"]');
    var networkModal = document.getElementById('our-network-modal');
    var closeNetworkModal = document.getElementById('close-our-network-modal');

    networkButton.addEventListener('click', function() {
        networkModal.style.display = 'block';
        loadNetworkInfo(); // Dynamically load "Our Network" content
    });

    closeNetworkModal.addEventListener('click', function() {
        networkModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == networkModal) {
            networkModal.style.display = 'none';
        }
    });

    function loadNetworkInfo() {
        // Example: dynamically load "Our Network" content
        var networkContainer = document.querySelector('.network-container');
        networkContainer.innerHTML = ''; // Clear previous content

        // Example content, replace with your actual data
        var networkData = [
            { title: 'Secure Webmail', content: 'Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.Experience our secure webmail service for seamless communication.' },
            { title: 'Online Gaming', content: 'Join our thrilling online games for endless entertainment.' },
            // Add more services as needed
        ];

        networkData.forEach(function(service) {
            var serviceItem = document.createElement('div');
            serviceItem.classList.add('network-item');
            serviceItem.innerHTML = `<h3>${service.title}</h3><p>${service.content}</p>`;
            networkContainer.appendChild(serviceItem);
        });
    }
});


export default async function getLanLon(q) {
    try {
        url = 'https://www.google.com/maps/search/' + q;
        const response = await fetch(url, {
            headers: {
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
            }
        });

        const data = await response.text();
        const regex = /window\.APP_INITIALIZATION_STATE=\[\[\[[-\d.]+,(-?\d+\.\d+),(-?\d+\.\d+)\]/;
        const matches = data.match(regex);

        if (matches === null) return [];

        if (matches.length < 3) return [];

        if (isNaN(matches[1]) || isNaN(matches[2])) return [];

        const latlon={ lat: matches[2], lon: matches[1] };

        async function sendCoordinates(lat, lon) {
            try {
                const response = await fetch('/api/save-coordinates', {
                    method: 'POST', 
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                    },
                    body: JSON.stringify({ lat: lat, lon: lon }) 
                });
        
                const data = await response.json();
                console.log(data.message); 
            } catch (error) {
                console.error('Error enviando las coordenadas:', error);
            }
        }

        sendCoordinates(latlon.lat, latlon.lon);

    } catch (error) {
        console.log(error);
        return [];
    }
}


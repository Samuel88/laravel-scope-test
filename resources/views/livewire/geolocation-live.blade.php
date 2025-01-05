<div id="geolocation" x-data="Geolocation">
    <div id="latitude" x-text="coords?.latitude"></div>
    <div id="longitude" x-text="coords?.longitude"></div>
</div>

@script
<script>
    Alpine.data('Geolocation', () => ({
        watchId: null,
        coords: null,
        timestamp: null,

        watchGeolocation(position) {
            const {coords, timestamp} = position;

            console.log(coords, timestamp);

            this.coords = coords;
            this.timestamp = timestamp;
            
            $wire.dispatch('geolocation-update', {
                coords,
                timestamp,
            });
        },

        init() {
            this.watchId = navigator.geolocation.watchPosition(this.watchGeolocation.bind(this));
        },
        destroy() {
            if (this.watchId) {
                navigator.geolocation.clearWatch(this.watchId);
            }
        }
    }));
</script>
@endscript
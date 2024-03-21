/**
 * Advertising Delivered Tracker jQuery Plugin
 * @project advertising TYPO3 Extension
 * @author Kevin Chileong Lee
 */
// Creat
class AdvertisingDeliveredTracker {
	/**
	 * Create a AdvertisingDeliveredTracker
	 */
	constructor(options) {
		const defaults = {
			endpoint: "tx_advertising_deliveredtracking%5Bbanner%5D=###BANNER###&type=###TYPE###",
			classes: {},
			selectors: {
				ads: ".ad"
			}
		};

		this.options = Object.assign(defaults, options);
		this.host = window.location.origin;
	}

	/**
	 * Start the delivered tracking
	 */
	startTracking() {
		document.querySelectorAll(this.options.selectors.ads).forEach((element) => {
			if (!element.hasAttribute("data-ad-delivered-uri")) {
				return;
			}

			const response = this.asyncFetch(this.host + element.getAttribute("data-ad-delivered-uri"));
			response.then((resolve, reject) => {
				// do nothing here
			});
		})
	}

	/**
	 * Async function to fetch uri
	 * @param String uri 
	 */
	async asyncFetch(uri) {
		return await fetch(uri);
	}
}

var advertisingDeliveredTracker = new AdvertisingDeliveredTracker();
advertisingDeliveredTracker.startTracking();
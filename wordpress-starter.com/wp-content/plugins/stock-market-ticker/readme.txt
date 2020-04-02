=== Stock Market Ticker ===
Contributors: stockdio
Tags: stock ticker, stock market ticker, ticker, financial ticker, stocks, market, news, quote, finance, quotes, stock, financial, index, indices, currency, currencies, commodities, forex, foreign exchange.
License: See www.stockdio.com/wordpress for details.
Requires at least: 3.1
Tested up to: 5.3
Stable tag: 5.3
Easy to use and versatile stock market ticker, with support of over 65 world exchanges, commodities, indices and currencies.

== Description ==

Stockdio's Stock Market Ticker contains a plugin and a widget that allow to display a ticker of stock market prices, market indices, currencies and commodities with their variations. Over 65 different stock exchanges and a large number of market indices, currencies and commodities are supported.

`[stock-market-ticker symbols="AAPL;MSFT;GOOG;HPQ;^SPX;^DJI;LSE:BAG" stockExchange="NYSENasdaq" width="100%" palette="financial-light"]`

This plugin is part of the Stockdio Financial Widgets, which also includes the following plugins:

* [Stockdio Historical Chart](https://wordpress.org/plugins/stockdio-historical-chart/).
* [Stock Quotes List](https://wordpress.org/plugins/stock-quotes-list/).
* [Stock Market Overview](https://wordpress.org/plugins/stock-market-overview/).
* [Stock Market News](https://wordpress.org/plugins/stock-market-news/).

The following parameters are supported:

**stockExchange**: The exchange market the symbols belong to (optional). If not specified, NYSE/NASDAQ will be used by default. For a list of available exchanges please visit www.stockdio.com/exchanges.

**symbols**: A list of companies stock symbols, market index tickers, currency pairs or commodities ticker, separated by semi-colon (;) (e.g. **AAPL;MSFT;GOOG;HPQ;^SPX;^DJI;LSE:BAG**). Please review the FAQ section for additional details on how to includes indices, currencies and commodities, as well as how to specify custom names, combine data from different exchanges, etc.

**scroll**: Allows to set the ticker's scrolling behavior (optional).

**speed**: Allows to change the ticker's scrolling speed. Supported values are: slowest, slower, slow, normal, fast and faster. (optional).

* Auto: ticker automatically scrolls (default).
* No: static ticker.

**layoutType**: A number specifying the layout type used to display the ticker. Please visit [www.stockdio.com/ticker_layouts](https://www.stockdio.com/ticker_layouts) to review the many ticker layout options available (optional).

**width**: Width of the list in either px or % (optional, default: 100%).

**height**: Height of ticker in px(optional, default: none). Normally, the ticker height is set automatically by the plugin, so in most cases this will not be necessary. However, certain plugins cause conflict and do not allow to set the height automatically; in those cases, you should set the ticker height manually.

**culture**: Allows to specify a combination of language and country settings, used to display texts and to format numbers and dates, e.g. Spanish-Spain (optional). For a list of available culture combinations please visit http://www.stockdio.com/cultures.

**motif**: Design used to display the visualization with specific aesthetics, including borders and styles, among other elements (optional). For a list of available motifs please visit www.stockdio.com/motifs.

**palette**: Includes a set of consistent colors used for the visualization (optional). For a list of available palettes please visit www.stockdio.com/palettes.

**font**: Allows to specify the font that will be used to render the chart. Multiple fonts may be specified separated by comma, e.g. Lato,Helvetica,Arial (optional).

**transparentBackground**: Allows to display the ticker with a transparent background, which is particularly useful when using image or gradient backgrounds on your page. By default, the ticker’s background color is inherited from the palette. Setting this to true overrides any background color. (optional)

**backgroundColor**: Allows to specify a color for the ticker's background. Color must be specified in RGB Hex format, without the # sign, e.g. use 000000 for black. By default, the ticker’s background color is inherited from the palette. (optional)

**labelsColor**: Allows to specify a color for the ticker's labels, such as the symbol and company name. Color must be specified in RGB Hex format, without the # sign, e.g. use 0000FF for blue. By default, the labels color is inherited from the palette. Prices and percent of change are usually displayed using positive and negative colors, rather than the labels color. (optional)

**positiveColor**: Allows to specify a color to be used as "Positive" color, i.e. when close price is greater than previous close price. Color must be specified in Hex format, without the # sign, e.g. use 00FF00 for green. By default, the positive color is inherited from the palette. (optional)

**negativeColor**: Allows to specify a color to be used as "Negative" color, i.e. when close price is smaller than previous close price. Color must be specified in Hex format, without the # sign, e.g. use FF0000 for red. By default, the negative color is inherited from the palette. (optional)

**loadDataWhenVisible**: Allows to fetch the data and display the visualization only when it becomes visible on the page, in order to avoid using calls (requests) when they are not needed. This is particularly useful when the visualization is not visible on the page by default, but it becomes visible as result of a user interaction (e.g. clicking on an element, etc.). It is also useful when using the same visualization multiple times on a page for different devices (e.g. using one instance of the plugin for mobile and another one for desktop). We recommend not using this by default but only on scenarios as those described above, as it may provide the end user with a small delay to display the visualization (optional).

== Installation ==

1. Upload the `StockdioPlugin` folder to your `/wp-content/plugins/` directory.

2. Activate the "Stock Market Ticker" plugin in your WordPress administration interface.

3. If you want to change the preset defaults, go to the Stock Market Ticker settings page.

4. Insert the `[stock-market-ticker]` shortcode into your post content, customizing it with the appropriate parameters. You also have the option to use the Stock Market Ticker widget included when you install the plugin.

5. For ease of use, a Stockdio icon is available in the toolbar of the HTML editor (see screenshots for details).

== Frequently Asked Questions ==

= How do I integrate the Stockdio Stock Market Ticker in my page? =

There are two options to integrate it: as a plugin, using the short code, or through the use of the widget in your sidebars.

= How do I know if the Stock Exchange I need is supported by Stockdio? =

Stockdio supports over 65 different world exchanges. For a list of all exchanges currently supported, please visit [www.stockdio.com/exchanges](http://www.stockdio.com/exchanges). Once you have found in the list the stock exchange you need, you must pass the corresponding Exchange Symbol using the stockExchange parameter.

= How do I specify the symbols to display? =

You can specify as many symbols as you want, from the selected exchange, separated by semi-colon (;). If any of the symbols you want to display does not show up, you can go to [http://finance.stockdio.com](http://finance.stockdio.com) to verify if the symbol is currently available in Stockdio. If the symbol you require is missing, please contact us at info@stockdio.com.

= Can I combine more than one stock exchange on the same ticker? =

Yes. The exchange you define in the stockExchange parameter will be the default stock exchange to be used. However, if you want to include symbols from a different exchange, you must prefix the symbol with the exchange code and a colon (:). For example, if you want to include two symbols from NYSE/Nasdaq but additionally include one symbol from London Stock Exchange, you would specify stockExchange="NYSENasdaq", and symbols="AAPL;MSFT;LSE:BAG". This will also allow you to combine stocks with commodities and currencies in the same ticker.

= Can I include one or more market indices in the ticker? =

Yes, you can include indices in the symbols parameter, using the ^ prefix. For example, use ^SPX for S&P 500 or ^DJI for the Dow Jones. For a complete list of indices currently supported, please visit [www.stockdio.com/indices](http://www.stockdio.com/indices)

= Can I create a Commodities ticker? =

Yes. You must use **COMMODITIES** as the stockExchange and then specify one or more commodities in the symbols parameter. For example, use GC;SI;CL for Gold, Silver and Crude Oil. For a complete list of commodities currently supported by Stockdio, please visit [www.stockdio.com/commodities](http://www.stockdio.com/commodities)

= Can I create a Currencies ticker? =

Yes. You must use **FOREX** as the stockExchange and then specify one or more currency pairs in the symbols parameter. For example, use EUR/USD, USD/JPY, GBP/USD for Euro vs. USD, USD vs. Japanese Yen and British Pound vs. USD. For a complete list of currencies currently supported by Stockdio, please visit [www.stockdio.com/currencies](http://www.stockdio.com/currencies)

= I would like to specify a custom name for a given symbol. Can I do that? =

Yes, we understand there are several scenarios in which you may want to display your own name, such as if you would like to display a commodities ticker in your own language. This can be easily done by specifying your custom name between parenthesis, right after you have specified the symbol. For example, you can create a commodities ticker in Spanish specifying the following in the symbols parameter: GC(Oro);SI(Plata);CL(Petróleo Crudo). This works for any symbol, index, commodity or currency pair.

= Can I specify the numbers and dates format used in my country/region? =

Yes, Stockdio supports a number of cultures, used to properly display numbers and dates. For a complete list of cultures currently supported by Stockdio, please visit [www.stockdio.com/cultures](http://www.stockdio.com/cultures).

= Can I customize the ticker layout? =

The plugin provides a large number of predefined ticker layout, which go from the very simple ones to more complex layouts including a mini chart and logos. For a complete list of ticker layouts currently supported by Stockdio, please visit [www.stockdio.com/ticker_layouts](http://www.stockdio.com/ticker_layouts). If you need a layout not currently available in the list, please contact us at info@stockdio.com.

= Can I specify my own colors for the ticker? =
This plugin is provided with a number of predefined color palettes, for ease of use. For a complete list of color palettes currently supported by Stockdio, please visit [www.stockdio.com/palettes](http://www.stockdio.com/palettes). However, if you need specific color customization, you can use the Stockdio iframe available at [http://services.stockdio.com](http://services.stockdio.com), which supports more options.

= Is the ticker data real-time or delayed? =
In most cases the data is delayed but the delay time may vary between 1 minute and 20 minutes, depending on the exchange. For details of intraday delay time for each exchange please visit [www.stockdio.com/exchanges](http://www.stockdio.com/exchanges).

= The company logo for one of the symbol is not correct or updated, can this be fixed? =
Sure! Simply contact us to info@stockdio.com with the correct or updated logo and we will update it, once it has been verified.

= Can I place more than ticker with different formatting on the same page? =
Yes. By default, all tickers will use the values specified in the plugin settings page. However, any of these values can be overridden using the appropriate shortcode parameter. Each shortcode can be customized entirely independent.

= How can I contact Stockdio if something is not working as expected? =

Simply send an email to info@stockdio.com with your question and we will reply as soon as possible.

= Can I create a Cryptocurrencies ticker? =

Yes. You must use CRYPTO as the stockExchange and then specify one or more cryptocurrencies in the symbols parameter. For example, use BTC;ETH;LTC for Bitcoin, Ethereum and Litecoin. For a complete list of cryptocurrencies currently supported by Stockdio, please visit [www.stockdio.com/cryptocurrencies](https://www.stockdio.com/cryptocurrencies).

= Can I create a Futures ticker? =

Yes. You must use FUTURES as the stockExchange and then specify one or more futures in the symbols parameter. For example, use GCM19;QAG19;FXH19 for Gold, Brent Oil and Eurostoxx. For a complete list of futures currently supported by Stockdio, please visit [www.stockdio.com/futures](https://www.stockdio.com/futures).

= Can I create a Bonds ticker? =

Yes. You must use BONDS as the stockExchange and then specify one or more bonds in the symbols parameter. For example, use US10YBY;UK10YBY; JA10YBY for US, UK and Japan's 10-Year Bond Yield. For a complete list of bonds currently supported by Stockdio, please visit [www.stockdio.com/bonds](https://www.stockdio.com/bonds).


== Screenshots ==

1. List of different Ticker Layouts currently available.

2. Example of ticker used to display a Equities with logos.

3. Example of ticker used to display a Commodities list.

4. Example of ticker used to display a World Markets Indices with a mini chart.

5. Example of ticker used to display a World Currencies List.

6. Stockdio Historical Chart is also available as a complement to the Stock Market Ticker.

7. Stockdio Stock Quotes List is also available as a complement to the Stockdio Market Ticker.

9. Stockdio Stock Market News is also available as a complement to the Stockdio Market Ticker.

10. Settings page.

11. Stockdio toolbar integration with easy to use dialog.

12. Stock Market Ticker widget dialog.

== Changelog ==
= 1.6.20 =
Release date: March 02, 2020

* Support for optional ticker Height parameter.

= 1.6.19 =
Release date: December 09, 2019

* Fixes issue with Load Data When Visible setting.

= 1.6.18 =
Release date: August 16, 2019

* Support for NEO Exchange (NEO).

= 1.6.17 =
Release date: January 31, 2019

* Support for Cryptocurrencies, Futures and Bonds.
* Fixes issue with deprecated functions.

= 1.6.16 =
Release date: October 24, 2018

* Fixes issue with ticker auto calculated height.

= 1.6.15 =
Release date: October 03, 2018

* Support for new cultures: Turkish, Arabic, Hebrew, Swedish, Danish, Finnish, Norwegian, Icelandic, Greek, Czech, Thai, Vietnamese, Hindi, Indonesian

= 1.6.14 =
Release date: Sept 18, 2018

* Fixes issue with ticker auto calculated height.

= 1.6.13 =
Release date: Sept 14, 2018

* Fixes issue with ticker loadDataWhenVisible property.

= 1.6.12 =
Release date: May 14, 2018

* Fixes issue with ticker broken images on settings page.

= 1.6.11 =
New features:

* Support for transparent background and custom ticker colors.

= 1.6.10 =
Release date: June 05, 2018
 
New features:
 
* Support for ability load data only when the visualization becomes visible. Please refer to the documentation for details.

= 1.6.8 =
Release date: May 25, 2018

* Support to change the ticker’s scroll speed

= 1.6.6 =
Release date: May 14, 2018

* Fixes issue with deprecated functions.

= 1.6.4 =
Release date: November 30, 2017

* Support for WordPress 4.9

= 1.6.3 =
Release date: August 3, 2017

Bug Fixes:

* Fixes an issue that might cause some visualizations to appear cut off.

= 1.6.2 =
Release date: August 2, 2017

* Enhancements on mobile display.

= 1.6.1 =
Release date: June 21, 2017

Bug Fixes:

* Some properties in Settings page and shortcode were not being honored during plugin rendering.

= 1.6 =
Release date: June 12, 2017

* Support for BATS ETF (included in the NYSENasdaq stockExchange category).

= 1.5 =
Release date: May 25, 2017

* Support for Canadian Securities Exchange (CSE).
* Support for new language and culture: Polish-Poland.

= 1.4 =
Release date: May 16, 2017

* Stock Market Ticker Widget is now available along with the plugin, for even easier integration.

= 1.3 =
Release date: March 28, 2017

* Compatibility with new plugins Marketplace.

= 1.2 =
Release date: March 22, 2017

* Compatibility with new Stock Market Overview plugin.

= 1.1 =
Release date: March 1, 2017

* New Feature: ability to combine different stock exchanges, commodities and currencies on the same quote list. Refer to the FAQ for details.

= 1.0 =
* Initial version.

== Upgrade Notice ==

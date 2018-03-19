# Ports and Adapters experiment

Which is better, driven adapters or driver adapters for input and output?

For years I've built driver adapters, ie, my controllers always wrap the usecase. However a [recent article](https://herbertograca.com/2017/11/16/explicit-architecture-01-ddd-hexagonal-onion-clean-cqrs-how-i-put-it-all-together/) made me want to try driven adapters, i.e. the usecase drives the adapters, like any other port. I wanted to see if it's possible, and if there's any benefit to doing it. 

The Clean Architecture advocates the driven approach, but I've never tried it myself, so this was my attempt at test driving both implementations.
 
 Each type has it's own structure, acceptance and unit tests. I've omitted any details not pertinent to the issue at hand, such as persistence, since there are always driven adapters.
 
 I've just finished writing both, and I intend to write up an analysis later on. I plan to compare both styles, in terms of how easy they are to write and how easy they are to test.


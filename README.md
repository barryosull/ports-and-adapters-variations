# Ports and Adapters experiment

Which is better, driven adapters or driver adapters for command/query input and output?

For years I've built driver adapters, (ie, my controllers always wrap the usecase). However a [recent article](https://herbertograca.com/2017/11/16/explicit-architecture-01-ddd-hexagonal-onion-clean-cqrs-how-i-put-it-all-together/) made me want to try driven adapters, i.e. the usecase drives the adapters. I wanted to see if it's possible to do, and if there's any benefit to doing it. 

The Clean Architecture advocates the driven approach, but I've never tried it myself, so this was my attempt at test driving both implementations.
 
Each type has it's own structure, acceptance and unit tests. I've omitted any details not pertinent to the issue at hand, such as persistence, since those are always driven adapters and are well understood.
 
## Thoughts so far
- I don't like how the output adapter turned out, it's basically a builder (which isn't a bad thing, now that I think about it)
- No matter which model is chosen, each usecase will have it's own signature, they are never uniform.
- Driven controllers are incredibly generic, their tests as well, makes testing a breeze
- Driven input and output unit tests are a doddle and are easy to understand
- Driver controller unit tests are much more complex

## Testing fun
As part of this I've also played around with building an application runner, that makes it easy to prep the system into a certain state, so tests are cleaner and the details are encapsulated. 
I'm quite happy with how this turned out, it's easy to understand and easy to modify. Both implementation have the same ApplicationRunner interface, so the point is kind of proven.
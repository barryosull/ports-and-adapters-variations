# Ports and Adapters experiment

Which is better, driven adapters or driver adapters for command/query input and output?

For years I've built driver adapters, (ie, my controllers always wrap the usecase). However a [recent article](https://herbertograca.com/2017/11/16/explicit-architecture-01-ddd-hexagonal-onion-clean-cqrs-how-i-put-it-all-together/) made me want to try driven adapters, i.e. the usecase drives the adapters. I wanted to see if it's possible to do, and if there's any benefit to doing it. 

The Clean Architecture advocates the driven approach, but I've never tried it myself, so this was my attempt at test driving both implementations.
 
Each type has it's own structure, acceptance and unit tests. I've omitted any details not pertinent to the issue at hand, such as persistence, since those are always driven adapters and are well understood.
 
## Thoughts so far
- Improving the readability of the acceptance tests and possibly encapsulating the `application` in a single concept will make it easier to see which is better.
- I don't like how the output adapter turned out, it's basically a builder (which isn't a bad thing, now that I think about it)
- No matter which model is chosen, each usecase will have it's own signature, they are never uniform.
- Driven controllers are incredibly generic, their tests as well, makes testing a breeze
- Driver controller unit tests are much more complex
- Driven input and output unit tests are a doddle and are easy to understand

## Next Steps
As part of this, I'm going to have some fun with testing as well. I want to explore acceptance tests and the framework that supports testing. I think I can write better tests that better showcase a system and it's functionality, without exposing too many internals.
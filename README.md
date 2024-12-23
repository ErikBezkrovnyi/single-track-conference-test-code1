# Introduction

You are working on an application for a single-track conference. The domain contains objects like Agenda, Speaker, Presentation and Workshop. There is also a small presentation layer responsible for aggregating data for views.

# Task definition

The core structure of classes from the domain and presentation layers is prepared for you. As you see, some methods contain `@todo` annotations, in these places you should write your own code. You can also have a look at some other parts of the source, maybe you need to add some code there too.

To complete this task you should:

* implement `Iterator` interface in `Agenda` class,
* implement `Countable` interface in `Agenda` class,
* implement text and datetime operations in presentation classes.

Please notice, all tests should be passed.

# Hints

The agenda class implements limited user data validation. Think about other classes in the application and how they could handle invalid input (according to good PHP practices).

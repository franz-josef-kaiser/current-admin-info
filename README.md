Current Admin Info
==================

Displays info about the current admin screen and its globals, contextual hooks, etc.

The info appears in new tabs in the »Contextual Help«-panel in the upper right corner of an admin screen.

## Currently available info tabs:

* Contextual hooks - all hooks that have »context«, the `$hook_suffix` in their name.
* Set Globals: Arrays/Objects are hidden and shown on click (js).
* Current screen info: Everything that the `$current_screen` object contains and isn't private.

------------------

<br /><sup>The contextual hooks tab.</sup>

<img src="https://raw.github.com/franz-josef-kaiser/current-admin-info/master/screenshot-1.png" />

<br /><sup>The available and set globals tab. Closed Arrays/Objects</sup>

<img src="https://raw.github.com/franz-josef-kaiser/current-admin-info/master/screenshot-2.png" />

<br /><sup>The available and set globals tab. Showing an open Array/Object</sup>

<img src="https://raw.github.com/franz-josef-kaiser/current-admin-info/master/screenshot-3.png" />

<br /><sup>The current screen tab.</sup>

<img src="https://raw.github.com/franz-josef-kaiser/current-admin-info/master/screenshot-4.png" />

_based on an idea by @StephenHarris [here](http://goo.gl/Mdtm0)._

## Extending with a child plugin

We now have [a dedicated Wiki Page to explain](https://github.com/franz-josef-kaiser/current-admin-info/wiki/Extending-with-child-plugins) this task.
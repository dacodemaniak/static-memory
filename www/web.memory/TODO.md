# Roadmap

## Remove logger message

Implement a Logger class that log only if dev mode

## From jQuery to Vanilla

- Remove old poor jQuery implementation for native JS.
- Add HTML Builder
- Review all of event handler to upgrade $ on to RxJS fromEvent
- Review best-player to update to native fetch function
- Replace dirty hidden CSS to brand new template tag

## New features

### Design
- Reskin platform and menu bar
- Redraw back card (so ugly now)
- Make the game responsive (adapt size to small devices)
- Show remaining time uppon the progress bar
- Show new animation when two card found
- Show remaining pairs and found pairs

### Settings
- Externalize settings (default time even no limit mode)
- Let user customize his game mode
- Add Helper mode (display cards returned but not paired)

### Multi player mode
- Let's play with another player (using sockets)
- Let's play gainst another player (speed up with same platform)

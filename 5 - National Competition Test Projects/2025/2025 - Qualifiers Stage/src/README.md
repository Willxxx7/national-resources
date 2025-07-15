# WorldSkills UK 2025, Stage 2 (Design Implementation)

## For Competitors

Distributable files are in [dist](dist). These files are intended to be shared with competitors and include the test project and media files.

## For Experts

Files relevant to the running of the competition are in [src](src). These files are intended for authorised members only and must NOT be shared with competitors.

### Marking Scheme Ideas

> [!NOTE]
> This list is not exhaustive and is purely to generate ideas whilst building the test project.

> [!TIP]
> To test some design skills, assess the competitors' ability to make the web page adaptive and/or responsive for different screen resolutions. Only provide a single design in one resolution; allow them to decide the rest.

- Common

  - [ ] **M** The page has the provided title (i.e., it is seen in the tab)
  - [ ] **M** All sections are present, at least partially
    - (deduct per entire missing section)
  - [ ] **M** The provided favicon is used (i.e., it is seen in the tab)
  - [ ] **J** The page offers good adaptiveness and/or responsiveness for different screen sizes
  - (assess at given screen resolutions)
    - Large: 1920 &times; 1080 (common web resolution)
    - Small: 400 &times; 850 (approximation of common phone resolutions)
    - (deduct per display issue, e.g., overflow)
  - [ ] **M** Smooth scrolling is enabled (e.g., when clicking on a Learn More link to be taken to the Registration section)

- **Hero**

  - [ ] **M** All described elements (e.g., title, subtitle) are present
    - (deduct per missing element)
  - [ ] **M** Register Your Interest anchor links to Registration section
  - [ ] **M** Countdown values are correct (days, hours, minutes, seconds)
    - (you can verify against https://www.timeanddate.com/countdown/generic?iso=20251201T00)
    - (accept one hour difference due to daylight saving times)
    - (deduct per mistake)
  - [ ] **M** Countdown dynamically updates every second
  - [ ] **M** Spark animation is implemented as provided

- About

  - [ ] **M** All described elements (e.g., heading, services) are present
    - (deduct per missing element)

- Services

  - [ ] **M** All described elements (e.g., images, descriptions) are present
    - (deduct per missing element)
  - [ ] **M** Learn More anchors link to the Registration section
    - (deduct per missing or invalid link)
  - [ ] **J** Service cards have a hover effect that enhances the design
    - (0 = no attempt)
    - (1 = poor attempt; there is a hover effect, but it looks amateurish and does not suit the design at all)
    - (2 = good attempt; there is a hover effect that looks fine but does not fully suit the design )
    - (3 = great attempt; the hover effect looks professional and suits the design well)

- Registration

  - [ ] **M** All described elements (e.g., heading, form) are present
    - (deduct per missing element)
  - [ ] **M** The registration form contains all described input fields
    - (deduct per missing field)
  - [ ] **M** The name field is required, such that it is not possible to submit the registration form without a value
  - [ ] **M** The name field is a text input field (`type=text`)
  - [ ] **M** The email field is required, such that it is not possible to submit the registration form without a value
  - [ ] **M** The email field is an email input field (`type=email`)
  - [ ] **M** The phone field is a telephone input field (`type=tel`)
  - [ ] **M** The phone field is optional, such that it is possible to submit the registration form with or without a value
  - [ ] **M** The interest fields are checkboxes
  - [ ] **M** Each input has an accessible associated label (e.g., nested inside a `<label />` or with `for` and `id` attributes)

- Contact

  - [ ] **M** All described elements (e.g., address, phone) are present
    - (deduct per missing element)
  - [ ] **M** Phone number is an anchor (for the `href`, accept any valid representation of the provided phone number, e.g., `tel:+441234567890` or `tel:01234567890`)
  - [ ] **M** Email is an anchor with the correct `href`, i.e., `to:hello@sparkstudios.com`
  - [ ] **M** Social icons are anchors (accept dummy `href`, e.g., `#`)
    - (deduct per mistake)

- Footer

  - [ ] **M** All described elements (e.g., coypright text, privacy policy link) are present
    - (deduct per missing element)
  - [ ] **M** Privacy policy and terms of service links are anchors (accept dummy `href`, e.g., `#`)
    - (deduct per mistake)
  - [ ] **M** The current year is updated dynamically using JS.

- Work Organisation and Management
  - [ ] **M** The submission is prepared as requested (archived, named following convention)
  - [ ] **J** The project is organised into sensible files and folders
  - [ ] **J** The project's files and folders have sensible names
  - [ ] **M** The HTML contains at least 5 comments
  - [ ] **M** The CSS contains at least 5 comments (across all files)
  - [ ] **M** The JS contains at least 5 comments (across all files)
  - [ ] **M** Modular CSS is used
  - [ ] **M** Modular JS is used
  - [ ] **M** HTML passes validation
  - [ ] **M** CSS passes validation
  - [ ] **M** The console does not contain any errors caused by erroneous code

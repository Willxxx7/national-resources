DUMMY DATA FOR SPARK STUDIO APPLICATION
========================================

This folder contains sample data extracted from the seeders for competitors
to use when creating their own database seeders.

AVAILABLE FILES
===============

JSON FORMAT (for programmatic use):
- admins.json           : Admin user accounts
- customers.json        : Customer records (8 customers)
- categories.json       : Event categories (13 categories)
- events.json           : Event records (30 events: 15 public, 15 private)
- pictures.json         : Complete picture records (98 pictures with all attributes)
- pictures_per_event.json : Picture count and naming for each event
- orders.json           : Sample orders with order pictures (9 orders)
- order_pictures.json   : Order pictures junction table (16 records)

CSV FORMAT (for spreadsheet/database import):
- admins.csv            : Admin user accounts
- customers.csv         : Customer records (8 customers)
- categories.csv        : Event categories (13 categories)
- events.csv            : Event records (30 events: 15 public, 15 private)
- pictures.csv          : Complete picture records (98 pictures with all attributes)
- pictures_per_event.csv : Picture count per event
- orders.csv            : Order records (9 orders)
- order_pictures.csv    : Order pictures junction table (16 records)

TXT FORMAT (human-readable):
- admins.txt            : Admin accounts with notes
- customers.txt         : Customer list with full details
- categories.txt        : Category list with notes
- events.txt            : Detailed event listing (separated by type)
- orders.txt            : Order details with picture references
- order_pictures.txt    : Order pictures junction table with pricing details
- pictures.txt          : Picture structure and naming conventions
- pictures_per_event.txt : Picture count and locators per event

DATABASE RELATIONSHIPS
======================

1. Categories
   - Independent table
   - Referenced by: Events

2. Events
   - Belongs to: Category
   - Has many: Pictures, Event Accesses
   - Types: "public" or "private"

3. Pictures
   - Belongs to: Event
   - Inherits category from event (NO direct category relationship)
   - Has unique pic_locator (format: E{event_id}P{sequence})
   - Stored in: storage/app/public/events/{event_id}/
   - Naming: event_{event_id}_pic_{number}.jpg

4. Customers
   - Independent table
   - Has many: Orders

5. Orders
   - Belongs to: Customer
   - Has many: Order Pictures (junction table)
   - Default status: "pending"

6. Order Pictures (junction table)
   - Belongs to: Order, Picture, Picture Size
   - Contains: pic_qty (quantity)

7. Admins (Users)
   - Independent table
   - Passwords should be hashed using bcrypt

IMPORTANT NOTES
===============

1. Picture Categories:
   Pictures DO NOT have a direct category field.
   They inherit the category from their associated event.
   This prevents logical inconsistencies (e.g., a "Summer" picture
   in a "Winter Sports" event).

2. Picture Locators:
   Format: E{event_id}P{sequential_number}
   Example: Event 7 pictures = E7P1, E7P2, E7P3, E7P4
   NOT based on picture_id, but on order within event.

3. Picture Naming:
   Format: event_{event_id}_pic_{number}.jpg
   Stored in: events/{event_id}/event_{event_id}_pic_{number}.jpg

4. Event Types:
   - "public" : Accessible to everyone
   - "private": Requires access code (stored in event_accesses table)

5. Access Codes:
   - Only for private events
   - Stored encrypted in database
   - Can be decrypted for display/verification

SEEDING ORDER
=============

To maintain referential integrity, seed tables in this order:

1. users (admins)
2. categories
3. events (requires categories)
4. customers
5. pictures (requires events)
6. event_accesses (requires events, optional)
7. picture_sizes (independent reference data)
8. orders (requires customers)
9. order_pictures (requires orders, pictures, picture_sizes)

PICTURE SIZES REFERENCE
========================

The picture_sizes table contains:
ID | Label      | Width  | Height | Price
---|------------|--------|--------|-------
1  | Small      | 800    | 600    | £5.00
2  | Medium     | 1200   | 900    | £10.00
3  | Large      | 1920   | 1440   | £15.00
4  | Extra Large| 2560   | 1920   | £20.00
5  | 4x6        | 1200   | 1800   | £8.00
6  | 5x7        | 1500   | 2100   | £12.00
7  | 8x10       | 2400   | 3000   | £18.00

CONTACT
=======

For questions about the data structure or seeding process,
refer to the Laravel seeders in:
src/database/seeders/

Good luck with the competition!

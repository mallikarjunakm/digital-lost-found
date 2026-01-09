# 📦 Digital Lost & Found Management System

## 📌 Project Overview

The **Digital Lost & Found Management System** is a web-based application designed to efficiently manage lost and found items in institutions such as colleges, offices, hostels, and public events.

The system introduces a **structured, role-based workflow** that helps users report lost items, claim found items, and enables administrators to verify claims, manage item lifecycles, and maintain audit logs for transparency.

---

## 🎯 Problem Statement

In many real-world environments:
- Lost items are found but not returned to their rightful owners
- There is no centralized tracking system
- Manual registers are inefficient and unreliable
- False claims are difficult to detect

This project solves these issues by providing a **controlled, digital workflow** for lost-and-found management.

---

## 🛠️ Tech Stack

- **Backend:** PHP  
- **Database:** MySQL  
- **Frontend:** HTML5, CSS, Bootstrap  
- **Client-side:** JavaScript  
- **Server:** Apache (XAMPP)  
- **Version Control:** Git  

---

## 👥 User Roles

### 🔹 User
- Login to the system
- Report lost items
- Claim found items
- View:
  - Items they reported
  - Items they have claimed
  - Claim status

### 🔹 Admin
- Secure login
- Add found items
- View all lost and found items
- Search and filter items by:
  - Item type
  - Date
  - Status
- View match suggestions
- Verify or reject claims
- Maintain audit logs

---

## 🔄 Project Workflow

1. **User reports a lost item**
   - Status: `open`

2. **Admin registers a found item**
   - Status: `unclaimed`

3. **System suggests possible matches**
   - Based on item type and date proximity

4. **User submits a claim**
   - Status: `pending`

5. **Admin verifies the claim**
   - If approved:
     - Lost item → `closed`
     - Found item → `returned`
     - Claim → `approved`
   - If rejected:
     - Claim → `rejected`

6. **All actions are logged**
   - Stored in audit logs for accountability

---

## 🗂️ Database Schema

### Tables Used

#### `lost_items`
- Stores lost item reports
- Linked to reporting user
- Status lifecycle: `open → closed`

#### `found_items`
- Stores found items added by admin
- Status lifecycle: `unclaimed → returned`

#### `claims`
- Links lost and found items
- Tracks ownership claims
- Status lifecycle: `pending → approved / rejected`

#### `claim_logs`
- Records admin actions
- Maintains chronological audit trail

---

---

## ▶️ How to Run the Project Locally

### Prerequisites
- XAMPP installed
- Apache and MySQL running

### Steps

1. Place the project in:
C:\xampp\htdocs\digital-lost-found

2. Create a MySQL database:
lost_found_system

3. Create required tables (`lost_items`, `found_items`, `claims`, `claim_logs`)

4. Configure database connection:
config/db.php


5. Open browser and go to:
http://localhost/digital-lost-found/


---

## 🔐 Authentication

- **User authentication:** Session-based (username)
- **Admin authentication:** Session-based with protected routes
- Unauthorized access is restricted using session checks

---

## 📊 Key Features

- Role-based access control
- User-specific dashboards
- Independent admin search and filters
- Manual claim verification (prevents fraud)
- Status lifecycle enforcement
- Audit logging for transparency
- Clean and structured UI

---

## 👨‍💻 Author

**Mallikarjuna K M**  
Digital Lost & Found Management System  

---


# 🏠 EasyColoc

EasyColoc is a Laravel-based web application designed to manage financial operations inside a colocation (shared apartment).  
It automates expense splitting, debt calculation, settlements, and reputation tracking using a clean MVC + Service Layer architecture.

---

## 🎯 Project Goal

EasyColoc helps colocation members:

- Add shared expenses
- Automatically split costs
- Calculate real-time balances
- Settle debts between members
- Track financial history
- Maintain a financial reputation score

The system follows Clean Architecture principles with clear OOP separation.

---

## 🧱 Architecture

### MVC Structure

**Models**
- User
- Colocation
- Category
- Expense
- ExpenseShare
- Payment

**Pivot Table: `colocation_user`**
- role (owner / member)
- left_at
- final_balance (snapshot when leaving)

---

## 🧠 Service Layer (Core Logic)

Business logic is extracted from controllers into dedicated services.

### 🔹 SettlementService

Handles the debt settlement algorithm:

1. Separate members into:
   - Creditors (positive balance)
   - Debtors (negative balance)

2. Use a progressive matching strategy to clear debts efficiently.

Returns an optimized collection of settlements.

---

### 🔹 ReputationService

Executed when a member leaves:

- If the member leaves with debt → reputation decreases
- If the member leaves with a clean balance → reputation remains stable or improves

---

## 💰 Expense System

When creating an expense:

- Validate user is active in the colocation
- Validate category belongs to the same colocation
- Split the amount equally among active members
- Automatically create ExpenseShare records

Balances are calculated dynamically to prevent data inconsistency.

---

## 💳 Payment System

When marking a payment as completed:

- Create a Payment record (from_user → to_user)
- Financial balances update automatically through dynamic calculation

No balance value is stored in the database.

---

## 🚪 Leave Logic

When a member leaves:

1. Calculate final balance
2. If the member has debt:
   - Transfer the remaining amount to the owner
3. Store:
   - left_at
   - final_balance
4. Execute ReputationService

---

## 📊 Dashboard

Displays:

- Total Paid
- Total Owed
- Current Balance (green if positive / red if negative)
- Recent Expenses
- Settlements ("X owes you" / "You owe X")

---

## 📁 History Page

Closed colocations become:

- Read-only
- Show final balances
- Show all expenses
- Show settlements
- No modification allowed

---

## 🧠 OOP Concepts Applied

- Single Responsibility Principle
- Dependency Injection
- Separation of Concerns
- Service Layer Pattern
- Pivot Data Modeling
- Collection manipulation
- Dynamic financial computation

---

## ⚠️ Technical Fixes Implemented

- Corrected debt transfer direction during leave
- Solved floating precision issues using epsilon
- Fixed settlement calculation crash cases
- Improved payment validation logic

---

## ✅ Current Status

- [x] Expense system  
- [x] Settlement algorithm  
- [x] Payment system  
- [x] Leave logic  
- [x] Reputation system  
- [x] History page  
- [x] Clean architecture  

---

## 🔜 Future Improvements

- Snapshot settlement storage
- Advanced reputation scoring
- Real-time notifications
- Multi-colocation support
- REST API version
- Unit testing for services

---

## 🛠 Tech Stack

- Laravel
- MySQL
- Blade
- Bootstrap / Tailwind
- MVC + Service Layer Architecture

---

## 👨‍💻 Author

Developed as an academic / personal project to demonstrate OOP design and financial logic implementation using Laravel.
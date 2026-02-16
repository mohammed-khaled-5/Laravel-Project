# LaraGigs - SaaS Job Board Application

A professional, production-ready job board platform built with **Laravel 11**. This project demonstrates a complete SaaS (Software as a Service) workflow, featuring tiered user plans, integrated payments, and automated cloud deployment.

## 🚀 Live Application
**[https://laravel-project-production-0a92.up.railway.app/]**

---

## 🌟 Key Features

### 🔐 Authentication & Security
* **User Accounts:** Full registration and login system with session management.
* **Password Recovery:** Secure password reset flow using **Resend** to deliver transactional email links.
* **Authorization:** Role-based access control ensuring users can only edit or delete their own listings.

### 💰 SaaS & Stripe Integration
* **Tiered Limits:** * **Free Plan:** Users are restricted to posting a single job listing.
    * **Pro Plan:** Subscription-based access for unlimited job postings.
* **Stripe Checkout:** Seamless payment experience for plan upgrades.
* **Stripe Webhooks:** Real-time database synchronization upon successful payment confirmation.

### 📝 Job Management (CRUD)
* **Listing Lifecycle:** Users can Create, Read, Update, and Delete job listings.
* **Media Management:** Support for company logo uploads, utilizing Laravel's storage system.
* **Filtering:** Advanced search and tag-based filtering for job seekers.

---

## 🛠️ Technical Stack

* **Framework:** Laravel 11 (PHP 8.4)
* **Web Server:** Apache (Dockerized)
* **Database:** MySQL
* **Payments:** Stripe API
* **Email:** Resend API
* **Hosting:** Railway (PaaS)

---

## 🏗️ DevOps & Deployment
The application is containerized using **Docker** and deployed via a custom CI/CD pipeline on Railway.

### Infrastructure Highlights:
* **Custom Entrypoint:** A bash script automates database migrations, clears configuration caches, and manages symbolic links for storage on every deployment.
* **Process Management:** Optimized Apache `mpm_prefork` configuration for stable PHP execution in a containerized environment.
* **Stateless Storage:** Configured `public` filesystem disks to handle persistent media visibility across deployments.

---

## ⚙️ Environment Variables
To run this project locally or in production, the following variables are required:

| Key | Value Source |
| :--- | :--- |
| `APP_KEY` | Laravel Application Key |
| `DB_URL` | MySQL DSN (Connection String) |
| `STRIPE_KEY` | Stripe Publishable Key |
| `STRIPE_SECRET` | Stripe Secret Key |
| `STRIPE_WEBHOOK_SECRET` | Stripe Signing Secret (`whsec_...`) |
| `RESEND_API_KEY` | Resend API Key |
| `FILESYSTEM_DISK` | `public` |

---

## 📜 Project Background
This project originated from a core curriculum and was significantly extended to include a subscription-based business model. The primary focus was transitioning from a local development environment to a hardened, cloud-deployed production state.

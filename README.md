<p align="center"><kbd><img src="https://haibubble.com/static-images/bubbleclinic.png" width="100%" alt="BubbleClinic Demo"></kbd></p>

## About BubbleClinic

<b>BubbleClinic</b> is an application used for the process of taking queue numbers at clinics. This kind of application helps in managing patient queues at clinics or health care centers. Here are some of the features that BubbleClinic may have:

### BubbleClinic Features:

-   <b>Dashboard</b><br>
    In the 'Dashboard', you will have access to see a summary of patient data for today, the number of patients from the previous day, the accumulation of patients in a month, and the total number of patients who have been served. The dashboard also provides the ability to analyze data with graphs that visualize patient information. In addition, you can quickly view the latest information of recently added queue data.

-   <b>Daftar Antrian</b><br>
    In the 'Daftar Antrian', you can easily retrieve queue numbers for patients. Apart from that, you can easily see the total patient queue for today. The search feature provided helps you find patient data quickly and efficiently. If the patient has come to the clinic, you can easily confirm his arrival.

    Not only that, you also have the flexibility to skip patients and move their queues into the 'Late Queue' category, ensuring better handling of patients who arrive at different times. With all these conveniences, organizing and providing timely service becomes more efficient.

-   <b>Antrian Terlambat</b><br>
    In the 'Antrian Terlambat' feature, you can easily see the number of patients who have registered for today's queue number but arrived late. With a clear display, you can identify these patients quickly. When a patient arrives, you can immediately confirm his presence with a single tap on the confirmation button provided.

    An efficient search feature is also available to make it easier for you to find patient data quickly. With fast and simple search capabilities, you can find information about specific patients easily.

    All these features are designed to speed up the queue management process and provide better service to your patients.

-   <b>Data Pasien</b><br>
    In the 'Data Pasien', information is available regarding the total number of patients who have received service. In addition, you can adjust, edit, or even delete patient data that is not needed or has been archived. There is also a search feature that makes it easy for you to find patient data quickly and precisely. In addition, with the filter by date feature, you can filter patient data according to a certain time range, speeding up access and management of the information you need.

-   <b>Pengaturan</b><br>
    In the 'Pengaturan' menu, you can view and change your personally identifiable information, including identity changes, password changes, and other settings related to the application.

## Installation

#### 1. Clone the repository

```sh
git clone https://github.com/bubblevy/bubbleclinic.git
```

#### 2. Copy .env

```sh
cp .env.example .env
```

#### 3. Configure .env

```sh
FAKER_LOCALE=id_ID
FILESYSTEM_DISK=public
```

#### 4. Install depedencies

```sh
composer install
```

#### 5. Generate Key

```sh
php artisan key:generate
```

#### 6. Run Symlink

```sh
php artisan storage:link
```

#### 7. Migrate database

```sh
php artisan migrate
```

#### 8. Database seeders

```sh
php artisan db:seed
```

#### 9. Reset antrian every day with cron job

```sh
php artisan schedule:work
```

#### 10. Run application

```sh
php artisan serve
```
#### <i><b>Note. username: admin & password: @Admin123</b></i>

## License

The BubbleClinic is open-sourced licensed under the [MIT license](https://github.com/bubblevy/bubbleclinic/blob/main/LICENSE).
